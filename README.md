# Ideas by taks

## Task 1
Since I do not know suitable contrib for CTA item I'd create new custom field.
It will consist of the 3 compononts: description (text), link (varchar),
link label (varchar)
The WYSIWYG editor is included in D8's core, it just has to be enabled on the
appropriate places (either field or textarea)
D8 core has default field for the image field also.

All fields will accept unlimited number of values.

As for the field re-arrangement I'd take a look at `field_weight` module. It seems
to provide the required features, but has to the ported for D8. At least there
might be some good ideas for how to achieve the goal.

## Task 2
Simple hook form alter will do the trick here based on user's role.

## Task 3
Create *ABC service module* providing the requited output based on post code input.

## Task 4
The field an it's position for the postcode is relatively easy, a challange here will be the validation of the data. At least hook form alter will be required for the validation if not creating separate widget for the input field.
The FE weather widget display is best to be in a custom formatter, this way it won't depend on the theme will be encapsulated and will be reausable in other sites/places/themes.

## Task 5
Load the weather widget via AJAX call.