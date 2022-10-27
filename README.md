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

### Shortcode
Copy the below shortcode and insert on pages where you want the posts to display. Change up search terms and taxonomies. See below for more definitions
#### Example Shortcode With All Parameters
```shortcode
[default_posts per_page="3" offset="0" tax_type_1="featured_post" terms_1="yes" tax_type_2="category" terms_2="sales" ]
```

#### Shortcode param definitions
- Post Offset (required):
How many posts you want to offset for the start - default is 0
```shortcode params
offset: 0
```
- Posts Per Page (required):
How many posts you want to show per page
```shortcode params
per_page: 1
```
- Taxonomy 1 (required):
The first category or custom post type slug to search within (i.e category for default categories or resource_type for custom post type)
```shortcode params
tax_type_1: resource_type
```
- Taxonomy 2:
The second category or custom post type slug to search within (i.e category for default categories or resource_type for custom post type)
```shortcode params
tax_type_1: resource_type
```
- Terms 1:
The first set of terms name to search for. Can search for multiple instead of 1. The terms MUST MATCH the tax_type_1 (EX. have to search for blog within category not resource type) (i.e sales, marketing for default categories or webinar, worksheet for custom post type)
```shortcode params
terms_1: webinar, category
```
- Terms 2:
The first set of terms name to search for. Can search for multiple instead of 1. The terms MUST MATCH the tax_type_2 (EX. have to search for blog within category not resource type) (i.e sales, marketing for default categories or webinar, worksheet for custom post type)
```shortcode params
terms_2: blog, sales
```

## Authors

- Kendra Mulligan
