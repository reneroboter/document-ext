page = PAGE
page {
    headerData {
        10 = TEXT
        10.value = <meta http-equiv="X-UA-Compatible" content="IE=edge">
        20 = TEXT
        20.value = <meta name="viewport" content="width=device-width, initial-scale=1">
    }

    includeCSS {
        bootstrap = EXT:documentext/Resources/Public/Bootstrap/css/bootstrap.min.css
        documentext = EXT:documentext/Resources/Public/Css/documentext.css
        jqueryui = https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css
        jqueryui.external = 1
        editor = EXT:documentext/Resources/Public/Css/bootstrap3-wysihtml5.css
        date = EXT:documentext/Resources/Public/Css/bootstrap-datetimepicker.min.css
    }

    includeJSlibs {
        jquery = //code.jquery.com/jquery.js
        jquery.external = 1
        jqueryui = https://code.jquery.com/ui/1.11.4/jquery-ui.min.js
        jquery.external = 1
        bootstrap = EXT:documentext/Resources/Public/Bootstrap/js/bootstrap.min.js
        editor = EXT:documentext/Resources/Public/Js/bootstrap3-wysihtml5.all.min.js
        moment = EXT:documentext/Resources/Public/Js/moment-with-locales.js
        date = EXT:documentext/Resources/Public/Js/bootstrap-datetimepicker.min.js
        script = EXT:documentext/Resources/Public/Js/script.js
    }

    shortcutIcon = fileadmin/files/favicon.ico

    10 = FLUIDTEMPLATE
    10 {
        file.stdWrap.cObject =< autoloader.template
        layoutRootPaths {
            10 = EXT:documentext/Resources/Private/Layouts/
        }

        partialRootPaths {
            10 = EXT:documentext/Resources/Private/Partials/
        }

        templateRootPaths {
            10 = EXT:documentext/Resources/Private/Templates/
        }

        variables {
            content < styles.content.get
        }

        settings {
            registerPid = {$page.settings.registerPid}
        }
    }
}
