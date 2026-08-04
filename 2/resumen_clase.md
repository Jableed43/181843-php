# 📚 Resumen de la clase — POO en PHP

> Preguntas y conceptos que salieron durante la clase, respondidos uno por uno,
> apoyados en el código de esta misma carpeta.

## 📂 Los archivos de esta carpeta

| Archivo | Qué contiene | ¿Se ejecuta? |
| :--- | :--- | :--- |
| `Video.php` | La **clase padre**: propiedades, constructor, getter/setter de duración y los métodos comunes (`reproducir`, `pausar`, `detener`, `proxCapitulo`, `antCapitulo`, `verInfo`) | No, solo define la clase |
| `Serie.php` | Clase **hija** de `Video`. Agrega `$temporadas` con su getter y setter. **No tiene constructor** | No, solo define la clase |
| `Pelicula.php` | Clase **hija** de `Video`. Agrega `$director`, usa `parent::__construct()` y hace **override** de `reproducir()`. Al final instancia "Inception" | ✅ Sí — es el punto de entrada |
| `peliculas.php` | El primer ejemplo de la clase: una `Video` mínima para ver **encapsulamiento** (`private` + getter + setter) | ✅ Sí — imprime `320` |

**Cómo correrlos:**
`http://localhost/181843/2/Pelicula.php` y `http://localhost/181843/2/peliculas.php`
(o por consola: `php Pelicula.php`)

⚠️ `peliculas.php` define **su propia** `class Video`, independiente de `Video.php`. Son dos versiones del mismo ejemplo en momentos distintos de la clase: la simplificada (solo `$duracion`) y la completa. Por eso **no hay que requerir los dos archivos juntos**: PHP no permite declarar dos veces la misma clase.

---

## 1. ¿Qué es la Programación Orientada a Objetos?

Es una forma de programar en la que el código se organiza en **objetos**: cosas que tienen **datos** (propiedades) y **acciones** (métodos), en vez de una lista suelta de instrucciones y funciones.

La idea de fondo es que el programa se parezca a cómo describimos el mundo real. Si en la vida real decís *"esta película dura 148 minutos y la puedo reproducir"*, en POO escribís una clase con una propiedad `$duracion` y un método `reproducir()`. Los datos y las acciones que operan sobre esos datos **viajan juntos** en la misma unidad.

Los cuatro elementos base:

| Elemento | Qué es | Dónde está en el código |
| :--- | :--- | :--- |
| 📋 **Clase** | La plantilla o molde | `class Video` en `Video.php` |
| 📺 **Objeto** | Una instancia concreta de esa clase | `new Pelicula("Inception", "Christopher Nolan")` al final de `Pelicula.php` |
| 💾 **Propiedad** | Un dato que el objeto *tiene* | `$titulo`, `$duracion`, `$genero`, `$lenguaje`, `$director`, `$listaActores` |
| ⚙️ **Método** | Una acción que el objeto *hace* | `reproducir()`, `pausar()`, `detener()`, `verInfo()` |

📄 Ver el comentario del encabezado de `peliculas.php`: ahí quedó anotada la lista de propiedades y métodos tal como la fuimos armando en clase, **antes** de escribir una línea de código. Ese es el orden correcto: primero se piensa, después se tipea.

---

## 2. ¿Qué es un paradigma?

Un **paradigma de programación** es una manera de pensar y estructurar un programa. No es una tecnología ni un lenguaje: es un enfoque, un conjunto de reglas sobre *cómo organizar* la solución.

| Paradigma | Cómo piensa el problema | Ejemplo |
| :--- | :--- | :--- |
| **Estructurado / imperativo** | Una secuencia de pasos: hacé esto, después esto | La clase anterior: variables, `if`, `for`, funciones |
| **Orientado a objetos** | Un conjunto de objetos que se comunican entre sí | Esta clase |
| **Funcional** | Transformaciones de datos mediante funciones puras, sin estado que cambie | `map`, `filter`, `reduce` |

Tres aclaraciones importantes:

* **Un paradigma no reemplaza al otro.** Adentro de un método POO seguís escribiendo `if` y `for` — programación estructurada pura. Se ve en `setDuracion()`: el método es POO, pero adentro hay un `if` común y corriente.
* **PHP es multiparadigma.** Podés escribir un script de 20 líneas sin una sola clase, y está perfecto.
* **El paradigma es una decisión de diseño, no del lenguaje.** Se puede escribir código horrible en POO y código excelente sin objetos.

---

## 3. ¿Por qué la POO es tan usada?

Respuesta honesta primero: **en un script de 20 líneas no aporta nada**. Sirve cuando el proyecto crece. Estas son las razones concretas, todas visibles en esta carpeta:

1. **Reutilización.** `Serie` y `Pelicula` heredan de `Video`: el constructor, `pausar()`, `detener()` y `verInfo()` se escribieron **una sola vez**. Sin herencia, ese código estaría copiado y pegado en los dos archivos.
2. **Mantenimiento.** Si mañana hay que cambiar cómo se muestra la información, se toca `verInfo()` en `Video.php` y cambia para todos. Con código copiado, hay que acordarse de todos los lugares.
3. **Encapsulamiento = menos bugs.** `$duracion` es `private` y solo se modifica por `setDuracion()`, que valida. Es **imposible** que un video termine con duración negativa. El objeto se defiende solo.
4. **Trabajo en equipo.** Cada persona toca su clase. La clase expone métodos públicos (un "contrato") y adentro puede cambiar lo que quiera sin romperle el código a los demás.
5. **Modela el negocio.** El código habla el idioma del problema: `Video`, `Serie`, `Pelicula`. Se entiende sin traducir.
6. **Es el idioma de los frameworks.** Esta es la razón práctica más urgente: **Codeigniter, Laravel y Symfony son POO de punta a punta.** Un controlador es una clase que hereda de una clase padre, igual que `Pelicula extends Video`. Sin esto, el framework parece magia negra.

---

## 4. Controles de acceso: `private`, `public` y `protected`

Los **modificadores de acceso** controlan **quién puede tocar qué**. Es la herramienta con la que se implementa el **encapsulamiento**.

| Modificador | Quién puede acceder | Ejemplo en el código |
| :--- | :--- | :--- |
| `public` | Todos, desde cualquier lado | Todos los métodos: `reproducir()`, `getDuracion()`, `setTemporadas()` |
| `protected` | La propia clase **y sus clases hijas** | `$titulo`, `$genero`, `$director` en `Video.php` |
| `private` | **Solo** la propia clase (ni las hijas) | `$duracion` en `Video.php`, `$temporadas` en `Serie.php` |

De más abierto a más cerrado: **`public` → `protected` → `private`**

**La regla práctica:** propiedades casi siempre `private` o `protected`; métodos generalmente `public`. Si vas a heredar, `protected`.

**¿Por qué no poner todo `public` y listo?** Porque si `$duracion` fuera pública, cualquiera escribe `$peli->duracion = -50;` y deja el objeto en un estado imposible. Con `private` + setter, vos ponés la regla:

> `private` no es para esconderle cosas a nadie: es para que nadie —ni vos dentro de 6 meses— pueda romper el objeto.

📄 Ver `peliculas.php`: ahí está el ejemplo completo con las dos líneas comentadas al final (`$peli->duracion = 120;` y `echo $peli->duracion;`). **Descomentalas para ver el error en pantalla:**
> `Fatal error: Cannot access private property Video::$duracion`

### Getters y setters
Si una propiedad es privada, la única forma de leerla o modificarla desde afuera es a través de métodos:

* **Getter** (`getDuracion()`): método que **trae** un valor.
* **Setter** (`setDuracion()`): método que **modifica** un valor — y de paso **valida** antes de aceptarlo.

Comparar las dos versiones del setter es instructivo:
* En `peliculas.php` (versión simple): solo castea con `(int)`.
* En `Video.php` (versión final): castea **y además** rechaza valores `<= 0` con un `if`. Esa es la versión que realmente protege al objeto.

### ⚠️ Por qué `$director` es `protected` y no `private`
`Video.php` declara `protected $director` y `Pelicula.php` lo vuelve a declarar, también `protected`. **Tienen que coincidir.** Si en `Pelicula` lo pusieras `private`, PHP corta con:
> `Fatal error: Access level to Pelicula::$director must be protected (as in class Video) or weaker`

La visibilidad heredada se puede **mantener o ampliar**, nunca achicar.

---

## 5. `$this`: ¿qué es y cómo se usa?

`$this` es una referencia al **objeto sobre el que se está ejecutando el método en este momento**.

La explicación que mejor funciona:

> Cuando escribís el código *adentro* de la clase, todavía no sabés qué objeto lo va a usar. Podría haber uno o mil. `$this` es la forma de decir: **"el que me esté llamando ahora"**.

Por eso, dentro de una clase, **siempre** se accede a lo propio con `$this->`:

* `$this->titulo` → ✅ correcto
* `$this->$titulo` → ❌ mal: **no lleva `$`** delante del nombre de la propiedad (con `$` PHP lo lee como "propiedad variable" y no encuentra nada)
* `$titulo` a secas → ❌ mal: eso sería una variable local suelta que no existe

**Este es el error N°1 de toda la unidad**, y aparece con un síntoma muy reconocible: la propiedad sale **vacía** más un warning de *"Undefined variable"*.

📄 Ver `Video.php`: todos los métodos lo usan. Fijate especialmente en `verInfo()`, donde `$this->` aparece cuatro veces seguidas — es el mejor lugar para probar el error a propósito: sacale el `$this->` a una sola y corré `Pelicula.php`.

Un detalle que se ve en el constructor de `Video.php`: `$this->setDuracion($duracion)`. **`$this->` también sirve para llamar métodos propios**, no solo propiedades.

---

## 6. Herencia

La herencia permite que una clase **tome todo lo que ya tiene otra** y le agregue o modifique lo suyo. La clase de la que se hereda es la **clase padre** (o base); la que hereda es la **clase hija** (o extendida).

En este código: `Video` es el padre; `Serie` y `Pelicula` son las hijas.

La hija recibe automáticamente las propiedades `public` y `protected` del padre y todos sus métodos. **`Serie` nunca declaró `reproducir()`, `pausar()`, `verInfo()` ni `__construct()`, pero los tiene todos.** Eso es herencia: mirá `Serie.php`, tiene solo 12 líneas y sin embargo un objeto `Serie` puede hacer todo lo que hace un `Video`.

Para qué sirve:

* **Reutilización:** el código común se escribe una vez, en el padre.
* **Personalización:** cada hija agrega lo suyo (`$temporadas` en `Serie`, `$director` en `Pelicula`).
* **Coherencia:** todos los videos responden a `reproducir()`, aunque cada uno lo haga a su manera.

**La pregunta que decide si corresponde herencia es "¿ES UN?":** ¿una Película **es un** Video? Sí → herencia. ¿Un Video **es un** Género? No → ahí va otra cosa (ver punto 12).

📄 Ver los comentarios dentro de `Pelicula.php`, que lo resumen bien: *"Hereda propiedades, constructor y métodos. Aun así podés hacer algunas modificaciones. No hace falta que escribamos todo de cero. Reutilización y personalización de una clase nueva."*

---

## 7. Uso de `extends`

`extends` es la palabra reservada que declara la herencia. Se escribe en la línea de definición de la clase hija: `class Pelicula extends Video`.

Traducido: *"heredá todo lo de `Video` y además agregá lo tuyo"*.

Tres cosas a tener en cuenta:

* **PHP tiene herencia simple:** una clase puede extender **una sola** clase padre. No existe `extends A, B`.
* **Las cadenas sí se permiten:** `A → B → C`. `C` hereda de `B`, que hereda de `A`.
* **El `require_once` va antes.** Para que `extends Video` funcione, PHP tiene que conocer la clase `Video`. Por eso `Serie.php` y `Pelicula.php` arrancan con `require_once "Video.php";`. Si falta, salta *"Class 'Video' not found"*.

**¿Por qué `require_once` y no `require`?** Porque `Serie.php` y `Pelicula.php` requieren los dos el mismo archivo. Si algún día un tercer archivo requiere a ambos con `require` a secas, PHP intentaría declarar la clase `Video` dos veces y moriría con:
> `Fatal error: Cannot declare class Video, because the name is already in use`

`require_once` pega el archivo **una sola vez** aunque diez lugares lo pidan. Es la misma razón por la que `peliculas.php` no debe cargarse junto a `Video.php`: las dos declaran `class Video`.

---

## 8. Las propiedades son variables internas que guardan datos propios de la instancia

Exacto, y la parte clave de la frase es **"propios de la instancia"**. Vale la pena desarmarla:

* **Son variables**, pero no sueltas: viven **adentro** de la clase y se acceden con `$this->`.
* **Son propias de cada instancia.** Este es el punto central: si creás dos objetos del mismo molde, cada uno tiene **su propia copia**. Si en `Pelicula.php` creás una segunda película, cambiarle el director a una **no toca** a la otra. Un molde, dos objetos, dos vidas separadas.
* **Se declaran con su modificador de acceso** (`private $duracion;`), lo que define quién puede verlas.
* **Pueden tener valor inicial:** `protected $listaActores = [];` arranca como array vacío. Sin esa inicialización valdría `null`, y un `foreach` sobre `null` da warning. Para propiedades que van a guardar listas, **inicializarlas siempre**.
* **Pueden guardar cualquier cosa:** un string (`$genero`, `$lenguaje`), un número (`$duracion`), un array (`$listaActores`)... **y también otros objetos** (ver punto 12).

Frente a los métodos, la regla para distinguirlas:

> **Propiedad = sustantivo (lo que el objeto ES o TIENE). Método = verbo (lo que el objeto HACE).**

Se ve clarísimo en el encabezado de `peliculas.php`: la lista de propiedades son todos sustantivos (título, duración, género, lenguaje, director, listaActores) y la de métodos, todos verbos (Reproducir, Pausar, Detener, ProxCapitulo, AntCapitulo, VerInfo).

---

## 9. ¿Qué es una entidad de sistema y qué relación tiene con las clases?

Una **entidad** es una *cosa* relevante del problema que estás modelando, que tiene **identidad propia** y datos que la describen. Es un concepto de **análisis y diseño**, anterior al código: sale de conversar sobre el negocio, no de programar.

En un sistema de streaming, las entidades son: `Video`, `Pelicula`, `Serie`, `Genero`, `Actor`, `Usuario`, `Suscripcion`.

**La relación con las clases es directa: cada entidad del sistema se convierte en una clase del código.**

| Mundo del problema | Mundo del código |
| :--- | :--- |
| Entidad | Clase |
| Un caso concreto de esa entidad ("Inception") | Objeto / instancia |
| Los datos que la describen | Propiedades |
| Lo que se puede hacer con ella | Métodos |
| Las relaciones entre entidades | Herencia (`extends`) o una propiedad que guarda otro objeto |

Por qué importa distinguirlas: **primero se identifican las entidades, después se escribe el código.** Si arrancás tipeando clases sin haber pensado qué entidades tiene tu sistema, terminás con clases gigantes que hacen de todo, o con datos importantes escondidos como strings sueltos dentro de otra clase.

Y eso es exactamente lo que pasa hoy en `Video.php`: **`$genero` es un `string` y `$listaActores` es un array vacío.** Los dos son entidades disfrazadas de propiedad simple. El punto 12 desarrolla por qué y qué hacer al respecto.

Este mismo análisis vuelve a aparecer más adelante: en una base de datos, cada entidad suele ser **una tabla**; en el patrón MVC de Codeigniter, cada entidad suele tener **su modelo**.

---

## 10. ¿Qué es `parent::__construct()`?

Es la forma de llamar **al constructor de la clase padre** desde la clase hija.

El motivo por el que hace falta: cuando la hija define su **propio** `__construct()`, ese constructor **reemplaza** al del padre — el del padre **deja de ejecutarse solo**. Si el padre era el que asignaba `$titulo` y la hija no lo llama, `$titulo` queda vacío.

`parent::__construct($titulo)` es decir: *"antes de hacer lo mío, dejá que el padre haga su parte"*.

Cómo leer la sintaxis: `parent` es "mi clase padre" y `::` accede a algo de la clase (no de la instancia). Se puede usar con cualquier método heredado, no solo el constructor: `parent::reproducir()` sirve para ejecutar la versión del padre desde una versión sobrescrita.

Dos detalles prácticos:

* **Va primero**, antes de asignar las propiedades propias de la hija. Se ve así en `Pelicula.php`: primero `parent::__construct($titulo);` y recién después `$this->director = $director;`. Primero se construye la base, después lo específico.
* **Si la hija NO define constructor, no hace falta nada:** hereda el del padre tal cual y se ejecuta solo. Es exactamente el caso de `Serie`, y el comentario del archivo lo explica: *"Serie no tiene constructor porque el constructor se utiliza cuando al instanciar querés guardar los valores de las propiedades, pero también puede no estar y podés setear los valores a través de métodos"*.

**Síntoma de que te lo olvidaste:** el objeto se crea sin error, pero el título sale vacío. Probalo: comentá la línea de `parent::__construct()` en `Pelicula.php` y corré el archivo — vas a ver *"Reproduciendo  dirigida por Christopher Nolan"*.

---

## 11. ¿Qué es *method override* y para qué se usa?

**Override** (sobrescritura) es **redefinir en la clase hija un método que ya existía en el padre**, usando el mismo nombre.

Cuando eso pasa, PHP ejecuta siempre la versión **más específica**: la de la hija. En este código:

| Clase | Qué devuelve `reproducir()` |
| :--- | :--- |
| `Video` (padre) | `Reproduciendo Inception` |
| `Pelicula` (hija, sobrescrito) | `Reproduciendo Inception dirigida por Christopher Nolan` |
| `Serie` (hija, sin sobrescribir) | Usa el del padre tal cual |

Para qué se usa:

* **Especializar un comportamiento heredado** que en la hija tiene que ser distinto: una película se anuncia con su director, una serie no.
* **Mantener una interfaz común:** todos los objetos siguen respondiendo a `reproducir()`, y cada uno hace lo suyo. Esto permite recorrer una lista mezclada de películas y series llamando `reproducir()` en todas, sin preguntar de qué tipo es cada una. Ese es el germen del **polimorfismo**.

Tres precisiones que evitan confusiones:

* **No reemplaza al padre.** El método del padre sigue existiendo y las otras hijas lo siguen usando: `Serie` sigue teniendo el `reproducir()` original.
* **Se puede reutilizar el del padre** desde la versión sobrescrita con `parent::reproducir()`, y agregarle cosas. Es "extender", no siempre "tirar y rehacer".
* **No confundir con sobrecarga (*overloading*).** Sobrecarga es tener varios métodos con el mismo nombre y distintos parámetros — algo que existe en Java o C#, pero que **PHP no soporta** de esa forma. En PHP se resuelve con parámetros opcionales, como el `$duracion = null` del constructor de `Video`.

📄 Ver el comentario en `Pelicula.php`: *"Override → sobreescribe implementación de algún método heredado. Toma lo heredado y lo personaliza."*

---

## 12. ¿Qué es lo importante a la hora de armar clases?

Esta fue la conclusión de la clase y es la parte más de **diseño** de todo el tema.

### A. Pensar bien las propiedades y qué posibilidades te da cada una
Antes de tipear, listá los datos de la entidad y preguntate **para qué te va a servir cada uno**. La propiedad no es solo un dato guardado: es lo que después te va a permitir **buscar, filtrar, ordenar y mostrar**. Una propiedad mal pensada limita todo lo que puedas hacer después.

Eso fue literalmente lo primero que hicimos, y quedó escrito en el encabezado de `peliculas.php`: la lista de propiedades y métodos **antes** del código.

### B. Si una propiedad tiene varios datos internos, considerá convertirla en clase

**El caso de `$genero`.** Hoy en `Video.php` es un `string`. Funciona... hasta que aparecen los problemas reales:

* No hay dónde guardar la **descripción** del género.
* Filtrar es frágil: `"Terror"`, `"terror"` y `"TERROR"` son tres géneros distintos para el sistema.
* Si mañana el género necesita un ícono o un color, no hay lugar donde ponerlo.

Convirtiendo `Genero` en **clase**, cada género pasa a ser una **entidad** con identidad propia: título, descripción, y lo que haga falta agregarle después. Se define **una vez** y se reutiliza en todos los videos. Y el filtrado pasa a ser confiable, porque comparás **objetos**, no strings escritos a mano.

> 🔜 **Todavía no está hecho.** `Video.php` tiene `protected $genero;` como string. Convertirlo en una clase `Genero` (con `$titulo` y `$descripcion`) es el próximo paso natural de este código.

### C. Una propiedad puede guardar muchos objetos: `$listaActores`

`Video.php` ya declara `protected $listaActores = [];`, pero por ahora está vacío y nada lo usa. La idea detrás es la misma que la del género, llevada a una lista.

Una propiedad no tiene por qué guardar un solo valor: puede guardar un **array de objetos**. Con una clase `Actor` adentro de ese array, el catálogo se vuelve **consultable**: "todas las películas de tal actor", "quiénes actúan en tal película", "de qué nacionalidad es cada uno".

Con un string `"DiCaprio, Hardy, Page"` nada de eso es posible sin parsear texto a mano.

Dos cuidados para cuando lo implementes:
* **Ya está bien inicializada en `[]`** — mantenerlo así; si valiera `null`, el `foreach` fallaría.
* **Que siga siendo `protected`**, y agregar los actores con un método `agregarActor()`, para que nadie meta un string donde van objetos `Actor`.

> 🔜 **Todavía no está hecho.** La propiedad existe, la clase `Actor` y el método `agregarActor()` son la tarea pendiente.

### D. Distinguir "ES UN" de "TIENE UN"
De B y C sale la distinción de diseño más útil de toda la unidad:

| Relación | Pregunta | Cómo se implementa | Ejemplo |
| :--- | :--- | :--- | :--- |
| **Herencia** | ¿A **ES UN** B? | `class A extends B` | `Pelicula` **es un** `Video` |
| **Composición** | ¿A **TIENE UN** B? | Una propiedad que guarda un objeto | `Video` **tiene un** `Genero` |

Error clásico: usar herencia para todo. `Video` **no** hereda de `Genero` — un video no *es* un género, *tiene* un género. Y **tiene muchos** actores, por eso `$listaActores` es un array.

### E. Empezar simple y refactorizar
El criterio "considerá hacerla clase **más adelante**" es literal: no arranques con quince clases el día uno. Empezá con `$genero` como string —como está hoy— y cuando necesites la descripción o el filtrado, convertilo en clase. **Diseñar de más es tan caro como diseñar de menos.**

### F. Que el objeto no se pueda romper desde afuera
Propiedades `private`/`protected`, y modificaciones a través de setters que validan. El `setDuracion()` de `Video.php` castea a entero y rechaza valores `<= 0`: eso garantiza que **ningún** video quede con duración negativa, sin importar quién lo use ni desde dónde.

---

## 🧩 Detalles de sintaxis que aparecieron en el código

### Parámetro con valor por defecto
`__construct($titulo, $duracion = null)` en `Video.php` hace que `$titulo` sea **obligatorio** y `$duracion` **opcional**. Por eso `Pelicula` puede llamar a `parent::__construct($titulo)` con un solo argumento. Permite crear un video sabiendo solo el título y completar la duración después con el setter.

⚠️ Los parámetros opcionales van **siempre al final** de la lista.

### El constructor pasando por el setter
En `Video.php` el constructor no asigna `$this->duracion = $duracion;` directo: llama a `$this->setDuracion($duracion)`. Así **la validación se aplica también al crear el objeto**, no solo al modificarlo. Si asignás directo desde el constructor, te salteás tu propio control.

Compará con `peliculas.php`, donde el constructor **sí** asigna directo: esa es la versión anterior, sin esa protección.

### Tipo de retorno
`public function setDuracion($newDuracion): void` — el `: void` declara que el método **no devuelve nada**. Es documentación que PHP verifica solo: si alguien le agrega un `return` con valor, tira error. Regla general: los setters son `void`, los getters devuelven el valor.

### El casteo `(int)`
`$d = (int)$newDuracion;` convierte lo que entre en un entero: `"120"` → `120`, `"abc"` → `0`. Combinado con el `if ($d > 0)`, deja pasar strings numéricos y frena la basura.

### Una clase puede no tener constructor
`Serie` no define `__construct()`: hereda el del padre y sus propios datos se cargan después con `setTemporadas()`. El constructor sirve para cuando querés que el objeto **nazca** con ciertos valores; si podés cargarlos más tarde, es perfectamente válido no tenerlo. **Ni el constructor ni el destructor son obligatorios.**

### El destructor (concepto, no está en este código)
`__destruct()` es el par del constructor: se ejecuta cuando el objeto deja de existir, al terminar el script o al hacer `unset($objeto)`. Sirve para tareas de limpieza (cerrar archivos o conexiones). **No se llama a mano.**

---

## 🏆 Las 8 reglas para llevarse

1. **La clase es el molde; el objeto es lo que sale del molde.** Cada `new` crea un objeto nuevo e independiente.
2. **Propiedad = sustantivo, método = verbo.** ¿El objeto lo *tiene* o lo *hace*?
3. **`$this->propiedad` se usa ADENTRO de la clase**, sin `$` delante del nombre. Es el error N°1.
4. **`private` = solo yo. `protected` = yo y mis hijas. `public` = todos.** Si vas a heredar, `protected`.
5. **El constructor corre solo al hacer `new`** — salvo que la hija defina el suyo, y ahí va `parent::__construct()`.
6. **Override = mismo nombre, comportamiento propio.** PHP ejecuta siempre la versión más específica.
7. **"ES UN" → herencia. "TIENE UN" → composición.** No todo se resuelve con `extends`.
8. **Si una propiedad tiene datos adentro, probablemente sea una entidad** esperando ser su propia clase. Miralo en `$genero` y `$listaActores`.

---

## ✅ Tarea pendiente sobre este código

1. **Instanciar una `Serie`.** Hoy `Serie.php` define la clase pero nadie la usa. Crear una serie, cargarle temporadas con `setTemporadas()` y llamar a `reproducir()` para comprobar que el método heredado funciona.
2. **Convertir `$genero` en la clase `Genero`** (con `$titulo` y `$descripcion`), según el punto 12.B.
3. **Crear la clase `Actor`** y el método `agregarActor()` para poblar `$listaActores`, según el punto 12.C.
4. **Probar los errores a propósito:** descomentar las dos líneas del final de `peliculas.php` y comentar el `parent::__construct()` de `Pelicula.php`. Ver qué error tira cada uno y entender por qué.

---

## 📂 Dónde está cada concepto

| Concepto | Archivo |
| :--- | :--- |
| Cómo pensar propiedades y métodos antes de codear | Encabezado de `peliculas.php` |
| Encapsulamiento, `private`, getter y setter | `peliculas.php` (versión simple), `Video.php` (versión con validación) |
| Clase, propiedades, constructor, `$this` | `Video.php` |
| Parámetro opcional, `: void`, casteo `(int)` | `Video.php` |
| Herencia y `extends` | `Serie.php` y `Pelicula.php` |
| Clase hija **sin** constructor | `Serie.php` |
| `parent::__construct()` y **override** | `Pelicula.php` |
| Instanciación y salida por pantalla | Final de `Pelicula.php` |
