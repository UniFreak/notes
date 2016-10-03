Installation
    install ruby and gem
    `gem install sass`
Command line
    Usage: sass [options] [INPUT] [OUTPUT]
    Description: Converts SCSS or Sass files to CSS.
    Common Options:
        -I, --load-path PATH             Specify a Sass import path.
        -r, --require LIB                Require a Ruby library before running Sass.
            --compass                    Make Compass imports available and load project configuration.
        -t, --style NAME                 Output style. Can be nested (default), compact, compressed, or expanded.
        -?, -h, --help                   Show this help message.
        -v, --version                    Print the Sass version.
    Watching and Updating:
            --watch                      Watch files or directories for changes.
                                         The location of the generated CSS can be set using a colon:
                                             sass --watch input.sass:output.css
                                             sass --watch input-dir:output-dir
            --update                     Compile files or directories to CSS.
                                         Locations are set like --watch.
        -f, --force                      Recompile every Sass file, even if the CSS file is newer.
                                         Only meaningful for --update.
            --stop-on-error              If a file fails to compile, exit immediately.
                                         Only meaningful for --watch and --update.
    Input and Output:
            --scss                       Use the CSS-superset SCSS syntax.
            --sourcemap=TYPE             How to link generated output to the source files.
                                             auto (default): relative paths where possible, file URIs elsewhere
                                             file: always absolute file URIs
                                             inline: include the source text in the sourcemap
                                             none: no sourcemaps
        -s, --stdin                      Read input from standard input instead of an input file.
                                         This is the default if no input file is specified.
        -E, --default-encoding ENCODING  Specify the default encoding for input files.
            --unix-newlines              Use Unix-style newlines in written files.
        -g, --debug-info                 Emit output that can be used by the FireSass Firebug plugin.
        -l, --line-numbers               Emit comments in the generated CSS indicating the corresponding source line.
            --line-comments
    Miscellaneous:
        -i, --interactive                Run an interactive SassScript shell.
        -c, --check                      Just check syntax, don't evaluate.
            --precision NUMBER_OF_DIGITS How many digits of precision to use when outputting decimal numbers.
                                         Defaults to 5.
            --cache-location PATH        The path to save parsed Sass files. Defaults to .sass-cache.
        -C, --no-cache                   Don't cache parsed Sass files.
            --trace                      Show a full Ruby stack trace on error.
        -q, --quiet                      Silence warnings and status messages during compilation.
Comment
    /* this will appear in generated css */
    // this will not
Variable
    types: number string color boolean null list
    start with: $
Nested rule
    a {
        span {

        }

        /* use & to reference a */
        &:hover {
        }

        /* can also nest property */
        font: {
            family: Helvetica;
            size: 200%;
            weight: bold;
        }
    }
Inheritance
    .button {
        /* inherit the style from a:hover */
        @extend a:hover
    }

    you can also use a `extend-only` selector and use `%` as a placeholder selector
Partial
    partial file begin with _, say a patial file named _partial.scss under partial/, you can import it with
    @import "partial/partial.scss"
Operator
    + - * / ()
Mixin
    /* mixin without arguments */
    @mixin mixin1 {}

    /* mixin with arguments */
    @mixin mixin2 ($arg1:defaultValue, $arg2, ...) {}

    /* mixin with variable arguments */
    @mixin mixin3 ($args...) {
        /* mixin can be called within mixin */
        @include mixin1;
    }

    p {
        @include mixin2 (arg1, arg, ...);
    }
Function
    @function funcName($arg) {
        @return ($arg * 1.5) * 2 + px;
    }

    Color
        lighten(color, amount)
        darken(color, amount)
        saturate(color, amount)
        desatuarte(color, amount)
        fadein(color, amount)
        fadeout(color, amount)
        fade(color, amount)
        mix(color1, color2)

        hue(color)
        saturation(color)
        lightness(color)
        alpha(color)
        grayscale(color)
        complement(color)
        invert(color)
    Math
        round(number)
        ceil(number)
        floor(number)
        percentage(number)
        abs(number)
        min(n1, n2, ...)
        max(n1, n2, ...)