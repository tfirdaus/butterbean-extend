# ButterBean Extend

A plugin that extends [ButterBean](https://github.com/justintadlock/butterbean), a neat little post meta box framework by [Justin Tadlock](http://justintadlock.com).

# Installation

Load it along with the ButterBean main library, as follows:

```
add_action( 'plugins_loaded', 'load_butterbean' );

function load_butterbean() {
        require_once( 'path/to/butterbean/butterbean.php' ); // Load main ButterBean library.
        require_once( 'path/to/butterbean-extend/butterbean-extend.php' ); // load ButterBean extension.
}
```

# Change Log

All notable changes to this project will be documented in this section.

## [0.0.1] - 2016-14-09
### Added
- A custom setting type: `serialize`.