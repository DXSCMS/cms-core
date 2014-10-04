## DXS CMS
Los sufijos **.cms.php** se referirán a parámetros, variables genéricos. Correspondientes al cms, o módulos. Aquellos que no lleven esos sufijos se pueden asumir que son específicos para la implementación del CMS.
Esto es válido para *SETTINGS* o *LANG* de cada módulo, etc.

### Manejo de Versiones 
Mayormente se incrementa el 2do dígito esto significa que se han realizado cambios significativos en la estructura del *CORE*.

Cuándo solo se incrementa el 3er dígito significa que puede ser remplazada la carpeta v3.8.X (por ejemplo) dentro de CORE, por la nueva, y no necesitará más modificaciones para el correcto funcionamiento.

En cambio el 2do dígito puede significar cambios en la estructura de archivos y carpetas de módulos o nombre de variables, por lo que si será necesario actualizar todo el CMS (el *CORE* mayormente) y los módulos.

El 1er dígito es rara vez incrementado, y esto significa un cambio total en la concepción del cms, las veces que se ha incrementado ha sido para volverse modular (**v2.x**) e implementar roles (**v3.x**).

A partir de la **v3.7** los módulos desarrollados incluidos en una versión liberada tendrán la misma versión (a 2 dígitos) del CMS, esto permitirá conocer con que versión fue liberada, si un módulo se actualiza antes de que se libere una nueva versión del CMS se incrementará el 3er dígito.

Cuándo no se especifica el 3er dígito, se asume que es .0

## v3.9

En esta versión se ha implementado el concepto de Permisos, ($_PERMS) para restringir (o autorizar) el acceso a una página específica de un módulo. 

## CMS POR DENTRO
### SESIONES

    $_SESSION[-idcms-][-subdom-][-access-] : Array();


(para significado de los id, ver Configuraciones del CMS)

*Se recomienda usar la variable **$_SS** objeto de la clase **SessionCMS** incluida en __CORE/tool.SessionCMS.class.php__*



    $_SS:SessionCMS Class
    	// Variables de Sesión Rol (Para un Rol específico)
    	->gt($var,$uns = false);	// get: obtiene una variable de Sesión Rol, el parametro $uns es para eliminar la variable al obtenerla.
    	->st($var,$val);			// set: coloca una variable de Sesión Rol
    	->nst($var);				// unset: borra una variable de Sesión Rol, invoca la función -unset()-
    	->ist($var);				// isset: verifica si existe una variable de Sesión Rol, invoca la función -isset()-
    	->mpty($var);				// empty: invoca la función -empty()-
    	->up($var);					// up: incrementa en 1 una variable, invoca a ++;
    	
    	// Variables Globales ($_SESSION); Tener cuidado con $_SESSION[-idcms-]
    	->stG($var,$val);			// setGlobal: coloca una variable de Sesión Global: $_SESSION[$var] = $val;
    	->gtG($var,$uns = false);	// getGlobal:
    	->nstG($var);				// unsetGlobal:
    	->istG($var);				// issetGlobal:

### VARIABLES DE SESSION PARA _LOGIN_
	[_cms_logged]
	[_cms_ses-exp]
	[_cms_login-error]
	[_cms_login-error-msg]
	[_cms_tlog]
	[_cms_ses-exp-bg]
	[_cms_login-attempts]
	[_cms_login-error]
	[_cms_login-error-msg]
	[_cms_login-error-type]
	[_cms_login-redirect]
Se recomienda que las variables utilizadas por el CMS empiezen con **[`_`cms`_`...]** y luego el nombre de la variable a continuación, separando las palabras por guión simple.

---
### VARIABLES GLOBALES
---
Se incluyen definiciones de **./dxs.cms.php**

    HOST : URI en la que se encuentra instalado el CMS
    ROOT ,$ROOT
    CORE
    LOGIN
    DATA
    	LIBS ,$LIBS
    	DATABASES ,$DATABASES
    LANGS ,$LANGS
    SKINS ,$SKINS
    MOD
    MODULE
    MODULES
    MODULESCMS
    MODULESROL
    MODULE
    MODULECMS
    SETTINGS
    
    MEDIA ,$MEDIA
    MEDIASKINS ,$MEDIASKINS
	
	//
    HMEDIA ,$HMEDIA				// HOSTED MEDIA (CDN)
    HMEDIASKINS ,$HMEDIASKINS	// HOSTED MEDIA SKIN (CDN)
    // Posiblemente Obsoletas
    
    SKIN		= SKINS / $_CMSSET[skin]
    iSKIN		= $_CMSSET[skin]
    MEDIASKIN	= MEDIASKINS  / $_CMSSET[skin]
    HMEDIASKIN	= HMEDIASKINS / $_CMSSET[skin]

---
### CMS SETTINGS (Configuraciones del CMS)
---

**$_CMSSET**[-idSett-]	// Se incluye variables encontradas en **SETTINGS/**

	stt.main.cms.php y SETTINGS/role.-idRole-.php
	[access] => developer				// (3) Identificador del Rol de Acceso, para manejar las variables de sesión de cada usuario por rol.
	[def_mod] => 
    [def_module] => debuger
	[idcms] => dxscms					// (1) Identificador del CMS, para manejar varias instancias. No es necesario cambiar este valor
	[lang] => es-ES
	[login_inc] => login_developer.php
	[login_skin] => login.php
	[login_user] => 1
	[logout-handler] => logout
    [module-handler] =>dxsmd
	[modules] => cms/modules/developer
	[page-ext] => php
    [page-handler] => pag
	[req_login] => 1
	[role] => developer					
	[role-sett] => cms/settings/role.developer.php
	[root-file] => dev
    [skin] => pulsepro
    [subdom] => v3.X-D					// (2) Identificador de la implementación del CMS, puede ser una abreviatura del nombre del sistema a desarrollar.
	[timemax-log] => 6000
	[use-json] => 1 			// Obsoleto en v3.7+, solo usado por el navigator

---
### USER SETTINGS (Configuraciones de Usuario)
---
$_SET[-idSett-] 

	[self] => dev.php | $_CMS["settings"]["root-file"] .'.'. $_CMS["settings"]["page-ext"]
		SETTINGS/stt.main.cms.php -> $_CMS["settings"]["root-file"]
		ROOT/*.php -> $_CMS["settings"]["page-ext"]
		
	[set-module] => true/false
    [cms-module] => debuger
    [set-page] => true/false
    [cms-page] => index
    
	[mod-tab-mode] => on/off/both/null
    [popup] => true/false
    [mod-req-login] => true/false
    [mod-show-mode] => on/off/both/null
	
    [module] => debuger
    [mod-page] => index
    
    [permission] => true/false -- Permiso del Modulo-Pagina actual
	
También incluye lo especificado en **$MOD_SET**[-idSett-] incluído en **./MODULESROL/-idModule-/data/settings.php**

---
### LANGUAGE (Idioma)
---

**$_LANG**[-idWord-]

Se incluye palabras globales especificadas en el Array **$_CMSLNG["global"]** en la carpeta **./LANGS/**
También agrega las palabras de cada `<Módulo>` **./MODULESROL/-idModule-/lang/**

Incluye:
	
	$MOD_LANG[-idWord-]
Se incluye en cada modulo, la carpeta **/-idModule-/lang/-idlang-.cms.php** (ej: `/lang/es-ES.cms.php`)
Son las palabras (genéricas) propias al módulo, utilizadas en las páginas del mismo.
Cuando se actualiza el módulo, este archivo puede ser reemplazado por el nuevo.
	
	$CMS_LANG[-idWord-]
Se incluye en cada modulo, la carpeta **/-idModule-/lang/-idlang-.php** 
(ej: `/lang/es-ES.php`)
Son palabras (específicas) de cada implementación del módulo, propias del cms. 
Por ejemplo el nombre del módulo en el CMS.

	$_CMSLNG[-idWord-]
Se incluye en **LANGS/-idLang-.cms.php** y **LANGS/-idLang-.php** son palabras para variables del CMS,
que se cargan antes de alguna página o módulo, por ejemplo el LOGIN
		
---
### INFO (Información)
---

`$_CMSINF = $_CMS["info"]`; // Archivo ubicado en **CORE/info.cms.php/** (v3.5+)

	["ver"]		= "3.2D"; 				// Version
	["adapt"]	= "WebApp Development"; // Adaptacion
	["ncms"]	= "DXS CMS"; 			// Nombre de CMS
	
	@v3.7+
	["url-cms"] = false/[link] 			// Enlace a la pagina web del cms
	["url-cms-ver"] = false/[link]		// Enlace a la pagina web de la versión actual del cms
	// estos enlaces se muestran en el footer.	

---	
### SKIN (Piel) - Added 2013/02/28 - at v3.4
---
`$_CMSSKIN` 

	["skin-id"]
	["skin-template"]
Estas variables ayudan a cargar la página (o módulo) con un skin diferente al global definido para el CMS. (*declarar en el preheader*)

---
## ARBOL DE ARCHIVOS
	-role-.php
		include_once dxs.cms.php;
		
		include_once CORE/init.cms.php;
		--------------------
		-> CORE/init.cms.php
		-------------------- 
							 ---------------------------
				include_once CORE/load.cms-settings.php;
							 ---------------------------
				-> CORE/load.cms-settings.php;
						include_once SETTINGS/stt.main.cms.php;
						include_once SETTINGS/stt.fb.php;
						
							 ------------------
				include_once CORE/info.cms.php;
							 ------------------
					$_CMSINF = $_CMS["info"];
				
							 --------------------
				include_once CORE/init.tools.php;
							 --------------------
					include_once CORE/tools/tool.functions.php;
					include_once CORE/tools/tool.URLCMS.class.php;
					$_URLCMS = new URLCMS();
					
							 -------------------
				include_once CORE/init.role.php;
							 -------------------
					include_once CORE/init.session.php;
					-> CORE/init.session.php;
						include 'tool.SessionCMS.class.php';
						$_SS = New SessionCMS();
	
					include_once CORE/load.settings.php;
					-> CORE/load.settings.php;
						include_once $_CMS["settings"]["role-sett"];
						$_CMSSET = $_CMS["settings"]
						
					*include CORE/core.logout.php;
					
					include_once CORE/load.lang.php;
					-> CORE/load.lang.php;
						include_once LANGS/$_CMSSET["lang"].php;
						$_LANG = $_CMSLNG["global"];
						
					include_once CORE/load.module-settings.php;
					-> CORE/load.module-settings.php;
						*$_SET['set-module'] = false;
						*$_SET['cms-module'] = null;
						
						*$_SET['set-page'] = false;
						*$_SET['cms-page'] = null;
						
						include_once MODULESROL/$_module/data/settings.php;
						include_once MODULESROL/$_module/data/settings.cms.php;
						
						define("MOD",$_module);
						define("MODULE",$_module);
						
						include_once MODULESROL/$_module/lang/$_CMSSET["lang"].php;
						$_LANG = array_merge_recursive($_LANG,$MOD_LANG);
					
					include CORE/core.login-eval.php;				
					*include CORE/core.login.php;
						-> CORE/core.login.php;
							include LOGIN/$_CMSSET["login_inc"];
							
							include CORE.'/load.login.php';
							-> CORE.'/load.login.php';
								define("SKIN",SKINS."/".$_CMSSET["skin"]);
								define("iSKIN",$_CMSSET["skin"]);
	
								define("MEDIASKIN",MEDIASKINS.'/'.$_CMSSET["skin"]); $MEDIASKIN = MEDIASKIN;
								define("HMEDIASKIN",HMEDIASKINS.'/'.$_CMSSET["skin"]); $HMEDIASKIN = HMEDIASKIN; 
	
								include SKINS/$_CMSSET["skin"]/login/$_CMSSET["login_skin"];
							
							
				include_once CORE/load.module.php;
					$_SET["mod-page"]
					$_SET["set-page"]
					$_SET["cms-page"]
					$_SET["error-page"]
					
	      include_once CORE/load.cms-permissions.php;
	        $_SET["permission"]
	
				include_once CORE/load.preheaders.php;
					*include MODULESROL/$_SET['module']/$_SET['mod-page'].preh.php;
				
				include_once CORE/load.skin.php;
					*include_once SKINS/$_CMSSKIN["skin-id"]/skin-templates/error.$_SET['error-page'].php;
					*include_once SKINS/$_CMSSKIN["skin-id"]/skin-templates/$skinTemplate.php;
					*include_once SKINS/$_CMSSET["skin"]/skin-templates/error.$_SET['error-page'].php;
					include_once SKINS/$_CMSSET["skin"]/skin-templates/$skinTemplate.php;
						-> 
							include CORE/block.head.php;
							include CORE/block.content.php; 
							include CORE/block.foot.php; 
	