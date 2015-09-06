<!---

        File name: _gettext_naming_convention.md

        Author: Daniel Racine
        Email: idaniel.racine@gmail.com

        This file is part of PROJECKLIST

        Copyright (c) 2015 Daniel Racine
        You should have received a copy of the MIT License
        along with PROJECKLIST. If not, see <https://en.wikipedia.org/wiki/MIT_License>.

-->





# gettext .po files "msgid" naming convention

***

## General rules

- Camel Case for unique identifiers.
- ONLY for `input` and `textarea` html tags, the gettext() "msgid" of their `label` tag must be the `name` attribute assigned to the input or textarea field. See example below:

	```html
        <!-- HTML/PHP example -->
        <input type="text" name="fld_contact_primary_fn" id="example"/>
        <label for="example"><?php echo gettext( 'fld_contact_primary_fn' ); ?></label>

        <!--
        # gettext portable object (.po) file examples

        # in en-CA .po file
        msgid "fld_contact_primary_fn"
        msgstr "First Name:"

        # in the fr-CA .po file
        msgid "fld_contact_primary_fn"
        msgstr "Prénom"
        -->
	```


## Common sub identifiers

- `ttl      =>	title`
- `stl 		=>	sub-title`
- `info 	=>	more information`
- `par 		=>	paragraph`
- `note 	=>	note`
- `btn 		=>	button`
- `fn[00]	=>	footnote`
- `[xxx] 	=> 	custom identifier`


## MSID examples
pattern example => [section name]-[subSection name 1]-[subSection name 1.1]-[identifier 1]-[identifier 1.1]

- `planning-contact-ttl`
- `planning-contact-note-[customIdentifier]`
- `planning-contact-primary-ttl`
- `planning-contact-primary-info`
- `planning-contact-primary-par`
- `planning-contact-primary-note`
- `planning-contact-primary-btn-[customIdentifier]`
- `planning-contact-primary-btn-[customIdentifier]`
- `planning-contact-alternate-ttl`
- `planning-contact-alternate-info`
- `planning-contact-alternate-par`
- `planning-contact-alternate-note`
- `planning-contact-alternate-btn-[ex:add]`
- `planning-contact-alternate-btn-[ex:remove]`







