<!---

File name: README.md

This file is part of PROJECKLIST

Copyright (c) 2015 Daniel Racine
You should have received a copy of the MIT License
along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.

-->





# PROJECKLIST


## What?

PROJECKLIST is a simple client project checklist /or questionnaire for website development.
This form provide walkthrough clarifications and educational specifications for each fields.
A summary is sent by email upon submition with a printable attachment.

Dead simple.

It's not perfect and need love.
Standards: HTML5/CSS3, PHP, JS


> [Google Forms](https://www.google.ca/forms/about/) offer a similar experience but less customizable...


## Why?

- Because filling word documents is painful
- Because repeating things is also painful
- Because I need to learn and practice code!
- Because .


## Features

- Responsive Form (RWD)
- Account Registration
- Save projects > Submit by email > delete.
- User's automatic L18N locale detection -> Fallback to en-CA if not supported
- L18N current locale support:
	- `en-CA -> DONE`
	- `fr-CA -> DONE`
	- `??-?? -> TBD`


## Contribution

YES please

**Suggestions:**

- Implementing new locales -> *localization*
- Additional content -> *question fields*
- Attachment options (ex. PDF, MSWord, etc.)

> Ensure to create and change the [reCaptcha](https://www.google.com/recaptcha) site key for your own usage.
> Ensure to create a config.json in the root directory to link to your database. Configuration files in "_doc" directory

## Content and Dependencies

### Content Inspiration

- First page results of [this Google search](https://www.google.ca/search?client=safari&rls=en&q=web+developpement+questionnaire&ie=UTF-8&oe=UTF-8&gfe_rd=cr&ei=b2e5VZ6fKoui8wfsqIHQAQ#q=web+development+questionnaire)
- [Contract Killer](http://stuffandnonsense.co.uk/projects/contract-killer/), link to original post

### Software requirements

- [Gettext](http://www.gnu.org/software/gettext/), Required
- [Poedit](https://poedit.net), Optional
- PHP 5.5+

### Components

- [HTML5 boilerplate](https://html5boilerplate.com), *including [jQuery](https://jquery.com) and [Modernizr](http://modernizr.com) libraries*
- [Skeleton](http://getskeleton.com)
- [Evernote sass built structure](https://github.com/evernote/sass-build-structure)
- [jQuery Validation Plugin](http://jqueryvalidation.org)
- [Font Awesome](http://fortawesome.github.io/Font-Awesome/)
- [Google Fonts](https://www.google.com/fonts)
- [PHPMailer](https://github.com/PHPMailer/PHPMailer)

### Snippets
Implementation of existing solutions to common problems found online. Attribution notices are embeded in the source code next to their implementation location.

## License

The MIT License
Copyright (c) 2016 Daniel Racine







