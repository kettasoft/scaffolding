# Scaffolding™

[![Run Tests](https://github.com/kettasoft/scaffolding/actions/workflows/ci.yml/badge.svg?event=push)](https://github.com/kettasoft/scaffolding/actions/workflows/ci.yml)

## Requirements

- PHP 7.4 or higher
- Database (eg: MySQL, PostgreSQL, SQLite)
- Web Server (eg: Apache, Nginx)

[//]: # "* [Other libraries]('To Be Added')"

## Framework

Scaffolding uses [Laravel](http://laravel.com), the best existing PHP framework, as the foundation framework
and [Module](https://nwidart.com/laravel-modules/v6/introduction) package for Apps.

## Installation

- Install [Composer](https://getcomposer.org/download) and [Npm](https://nodejs.org/en/download)
- Clone the repository: `git clone https://github.com/kettasoft/scaffolding.git`
- if you want to change dashboard colors ?
- before running: `npm run dev`
  change `INSTALLER_CHOSEN_COLOR, MIX_INSTALLER_CHOSEN_COLOR, DASHBOARD_CHOSEN_COLOR, MIX_DASHBOARD_CHOSEN_COLOR` and
  set your desired color without `#`
- Install dependencies: `composer install ; npm install ; npm run dev`
- Create new MySQL database for this application
- Install Scaffolding:

simply visit this url `{{app_url}}/installer` and follow instructions

- Or :

If you use valet or linux system just execute the init.sh file to configure your environment automatically.

```bash
sh init.sh
```

- Or :

If you use Windows system just execute the init.bat file to configure your environment automatically.

```bash
init.bat
```

- Or :

```bash
php artisan install
```

- Or :

```bash
php artisan install --db-name="scaffolding" --db-username="root" --db-password="" --admin-name="admin" --admin-email="admin@demo.com" --admin-phone="987654321" --admin-password="password"
```

- Create sample data (optional):

```bash
php artisan sample-data:seed
```

- Or if you want a specific number

```bash
php artisan sample-data:seed --count="your count here"
```

<details open> 
  <summary><h2>📦 Scaffolding dependencies</h2></summary>
  <!-- Repo info cards - https://github.com/anuraghazra/github-readme-stats -->
  <!-- Small repo cards (fork) - https://github.com/DenverCoder1/github-readme-stats -->
  <p align="left">
    <a href="https://github.com/nWidart/laravel-modules"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin/?username=nWidart&repo=laravel-modules&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="github-readme-streak-stats"></a>
    <a href="https://github.com/diglactic/laravel-breadcrumbs"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin/?username=diglactic&repo=laravel-breadcrumbs&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="readme-typing-svg"></a>
    <a href="https://github.com/laravel/scout"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin?username=laravel&repo=scout&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="custom-icon-badges"></a>
    <a href="https://github.com/santigarcor/laratrust"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin/?username=santigarcor&repo=laratrust&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="unicode-formatter"></a>
    <a href="https://github.com/laraeast/laravel-settings"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin/?username=laraeast&repo=laravel-settings&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="unicode-formatter"></a>
    <a href="https://github.com/spatie/laravel-backup"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin/?username=spatie&repo=laravel-backup&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="unicode-formatter"></a>
    <a href="https://github.com/laraeast/laravel-bootstrap-forms"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin/?username=laraeast&repo=laravel-bootstrap-forms&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="unicode-formatter"></a>
    <a href="https://github.com/calebporzio/parental"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin/?username=calebporzio&repo=parental&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="unicode-formatter"></a>
    <a href="https://github.com/ahmed-aliraqi/laravel-media-uploader"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin/?username=ahmed-aliraqi&repo=laravel-media-uploader&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="unicode-formatter"></a>
    <a href="https://github.com/ARCANEDEV/LogViewer"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin/?username=ARCANEDEV&repo=LogViewer&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="unicode-formatter"></a>
    <a href="https://github.com/jenssegers/date"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin/?username=jenssegers&repo=date&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="unicode-formatter"></a>
    <a href="https://github.com/404labfr/laravel-impersonate"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin/?username=404labfr&repo=laravel-impersonate&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="unicode-formatter"></a>
    <a href="https://github.com/laracasts/flash"><img width="278" src="https://denvercoder1-github-readme-stats.vercel.app/api/pin/?username=laracasts&repo=flash&theme=react&bg_color=282a36&title_color=bd93f9&hide_border=true&icon_color=F8D866&show_icons=false" alt="unicode-formatter"></a>
</details>

