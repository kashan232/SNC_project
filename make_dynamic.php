<?php
// Update Setting Model
$modelFile = 'app/Models/Settings.php';
$content = file_get_contents($modelFile);
if (strpos($content, "'theme_color'") === false) {
    $content = str_replace("'email',", "'email','theme_color',", $content);
    file_put_contents($modelFile, $content);
}

// Update Setting Controller
$controllerFile = 'app/Http/Controllers/SettingController.php';
$content = file_get_contents($controllerFile);
if (strpos($content, "theme_color") === false) {
    $content = str_replace(
        "request()->validate([",
        "request()->validate([\n            'theme_color'=>'required|string',",
        $content
    );
    file_put_contents($controllerFile, $content);
}

// Update Backend View
$viewFile = 'resources/views/backend/setting.blade.php';
$content = file_get_contents($viewFile);
if (strpos($content, "theme_color") === false) {
    $input = <<<HTML
        <div class="form-group">
          <label for="theme_color" class="col-form-label">Theme Color <span class="text-danger">*</span></label>
          <input type="color" class="form-control" name="theme_color" required value="{{\$data->theme_color ?? '#d35400'}}" style="height: 50px;">
          @error('theme_color')
          <span class="text-danger">{{\$message}}</span>
          @enderror
        </div>
HTML;
    $content = str_replace('<div class="form-group mb-3">', $input . "\n        " . '<div class="form-group mb-3">', $content);
    file_put_contents($viewFile, $content);
}

// Update Frontend Master
$masterFile = 'resources/views/frontend/layouts/master.blade.php';
$content = file_get_contents($masterFile);
if (strpos($content, "--primary-color") === false) {
    $css = <<<HTML
@php
    \$settings = DB::table('settings')->first();
    \$themeColor = \$settings->theme_color ?? '#d35400';
@endphp
<style>
    :root {
        --primary-color: {{\str_replace(';', '', \$themeColor)}};
    }
</style>
HTML;
    $content = str_replace('</head>', $css . "\n</head>", $content);
    file_put_contents($masterFile, $content);
}

echo "Files updated.\n";
