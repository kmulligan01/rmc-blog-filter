# Blog Filter Plugin

Use this plugin to activate a category list of checklists that will run an ajax call when clicked on posts for filtering in Wordpress. It will filter custom post types as well as base categories. This is just a base plugin, and the styles will need to be swapped out per solution. The styles are basic CSS.

## Usage

1. Download
2. Send to zip file
3. Upload as plugin in plugin directory

### Block & Elementor Usage

1. Search for 'Cat List Checkbox' in blocks on page
2. After inserted, fill in text boxes for list title, taxonmy to search, and the wording for the 'all types' text.
3. Save

### Shortcode

Here is the shortcode to use wherever you need it for a basic query search. This doesn't need to be attached to the blog filter:

```shortcode
[default_posts]
```
Here are the params to fill in for the shortcode:

```shortcode params
offset: How many posts you want to offset for the start - default is 0
per_page: How many posts you want to display on the page - default is 1
tax_type: Set to search resource_type which is a custom taxonomy
cat_type: Base category search
terms: What terms you want to search within your category

Example shortcode with params:
[default_posts offset="3" per_page="6" tax_type"resource_type" terms="webinar,ebook"]
```

### To Attach Filtered Posts With Cat Checklist

1. After adding the cat list checkbox to the page (see above), add a custom html section where you want your filterd posts to display on the page. In this section, add:

```html
<div id="demo"></div>
```
This section is IMPORTANT because it is where your ajax posts result will be displayed.

2. Next, wrap your default posts shortcode in this div:

```html
<div id="is-container">
    [shortcode goes here]
</div>
```
This step enables the smooth animation transition, and hides all your posts on filter click.
## Authors

- Kendra Mulligan
- Evercommerce Web Dev Team
