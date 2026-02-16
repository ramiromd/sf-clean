# ADR-001 — Hash de contraseñas sin acoplar el dominio a Symfony

## Estado
**Aceptado**

## Contexto

El sistema requiere gestionar contraseñas de usuarios de forma segura utilizando el componente
`PasswordHasher` de Symfony.  
Sin embargo, el enfoque recomendado por el framework implica que la entidad `User` implemente
interfaces como `PasswordAuthenticatedUserInterface`, lo cual introduce un acoplamiento directo
entre el **dominio** y el **framework**.

Dado que el proyecto adopta principios de **DDD**, **Clean Architecture** y **Inversión de Dependencias**,
se considera indeseable que las entidades de dominio dependan de contratos definidos por Symfony.

## Decisión

Se decide:

- Mantener las entidades de dominio **libres de dependencias del framework**
- Definir un **puerto de dominio** (`PasswordHasher`) que represente la necesidad de hashear contraseñas
- Implementar dicho puerto en la **capa de infraestructura** usando el hasher de Symfony
- Introducir un **Adapter / Anti-Corruption Layer** para cumplir con los requisitos del componente de seguridad de Symfony sin exponerlos al dominio

## Implementación

### Paso 1 - Entidad de dominio (pura)

```php
final class User
{
    private string $hashedPassword;

    public function changePassword(string $hashedPassword): void
    {
        $this->hashedPassword = $hashedPassword;
    }

    public function hashedPassword(): string
    {
        return $this->hashedPassword;
    }
}
```

Responsabilidades

- Mantener estado consistente.
- No ejecutar lógica técnica.
- No depender del framework (Symfony).

### Paso 2 - Definición del puerto de dominio

El dominio define **qué necesita**, no **cómo se implementa**.

```php
interface PasswordHasher
{
    public function hash(User $user, string $plainPassword): string;
}
```

Este puerto:

- Vive en el dominio.
- Permite la inversión de dependencias.
- Hace testeable la lógica de aplicación.

### Paso 3 - Implementación en infraestructura

Realizamos la implementación, de la interface definida en el paso anterior, en la capa de infraestructura haciendo uso de las utilidades provistas por el Framework.

```php
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class SymfonyPasswordHasher implements PasswordHasher
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {}

    public function hash(User $user, string $plainPassword): string
    {
        return $this->hasher->hashPassword(
            new SecurityUserAdapter($user),
            $plainPassword
        );
    }
}
```

Responsabilidad:

- Adaptar el contrato del dominio al mecanismo provisto por el Framework.

### Paso 4 - Anti corruption layer

Se implementa un adapter para cumplir con el contrato esperado por Symfony, de una entidad usuario; sin exponerlo al dominio.

```php
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

final class SecurityUserAdapter implements PasswordAuthenticatedUserInterface
{
    public function __construct(private object $domainUser) {}

    public function getPassword(): ?string
    {
        return null;
    }
}
```

Objetivo:

- Evitar que la infraestructura contamine el dominio.

### Consideraciones finales

Configurar el inyector de dependencias y utilizar el hasher en los componentes requeridos :)

--- 
## Consecuencias

**Positivas**
- Dominio completamente framework-agnostic
- Cumplimiento estricto de DIP
- Test unitarios sin Symfony
- Fácil reemplazo del hasher
- Diseño alineado con DDD y Hexagonal

**Negativas**
- Mayor cantidad de clases
- Necesidad de adapters explícitos
- Leve aumento de complejidad inicial

## Alternativas descartadas

### Entidad implementando interfaces de Symfony

Rechazada por acoplamiento directo al framework.

### Hashear contraseñas dentro de la entidad

Rechazada por mezclar lógica de seguridad con dominio.

### Hashear en controladores

Rechazada por violar separación de responsabilidades.


## Conclusión

El hashing de contraseñas se modela como un detalle de infraestructura,
expuesto al dominio mediante un puerto, preservando la pureza del modelo
y permitiendo integrar Symfony sin comprometer el diseño.


