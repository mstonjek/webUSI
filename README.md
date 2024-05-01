# Unie škol inovativních (UŠI) - Webová stránka

Tento projekt je webová stránka Unie škol inovativních (UŠI), postavená v jazyce PHP. Obsahuje informace o členech unie, aktuality, akce a další relevantní informace.

## Jak spustit projekt

Následující kroky vysvětlují, jak spustit tento projekt na vašem lokálním počítači pomocí XAMPP:

### 1. Stažení a instalace XAMPP

- Navštivte [oficiální web XAMPP](https://www.apachefriends.org/index.html) a stáhněte si nejnovější verzi XAMPP pro váš operační systém.
- Postupujte podle pokynů pro instalaci XAMPP na vašem počítači. Instalátor vám umožní vybrat složku, do které bude XAMPP nainstalován. Doporučuje se ponechat výchozí nastavení.

### 2. Stažení projektu

- Stáhněte si zdrojový kód projektu UŠI z [repozitáře na GitHubu](https://github.com/mstonjek/webUSI).
- Rozbalte stažený soubor do adresáře `htdocs` ve složce, kde je nainstalovaný XAMPP. Tato složka se obvykle nachází v `C:\xampp\htdocs` na systémech Windows nebo `/Applications/XAMPP/htdocs` na systémech macOS.

### 3. Spuštění Apache a MySQL serverů v XAMPP

- Spusťte XAMPP Control Panel a klikněte na tlačítko `Start` vedle `Apache` a `MySQL`. To spustí Apache HTTP server a MySQL databázový server na vašem počítači.

### 4. Import databáze - Zatím ve vývoji

- Otevřete webový prohlížeč a přejděte na adresu `http://localhost/phpmyadmin`.
- V sekci `Databases` vytvořte novou databázi s názvem `usi`.
- Klikněte na vytvořenou databázi a zvolte zálohu.
- Načtěte databázový soubor z adresáře projektu `usi_database.sql` (pokud je k dispozici) nebo importujte strukturu databáze z jiného zdroje.

### 5. Spuštění webové stránky

- Otevřete webový prohlížeč a přejděte na adresu `http://localhost/webUSI/pages`.
- Měli byste vidět domovskou stránku webové stránky UŠI.
- Prozkoumejte různé části webu, včetně členů, aktualit, akcí
