Getting Started
===============

Thank you for purchasing my theme. If you have any questions that are beyond the scope of this help file, please feel free ask any questions on the online [Support Forum](http://support.themewich.com/discussions). Thanks so much!

Installation
------------

> **WordPress is required** 
> 
> To install this theme you must have a working version of WordPress already installed. For information regarding the installation of the WordPress platform, please see the [WordPress Codex](http://codex.wordpress.org/Installing_WordPress).

Once wordpress is installed, you can upload the theme files and activate the theme. The theme files can be uploaded in two ways:

#### FTP Upload

Using your FTP program, upload the non-zipped theme folder into the **/wp-content/themes/** folder on your server.

#### WordPress Upload

First, unzip the downloaded zip file. Navigate to **Appearance > Add New Themes > Upload**. Go to browse, and select the zipped theme folder, called **struck.zip**. Click **Install Now** and the theme will be uploaded and installed.

Once the theme is uploaded, you need to activate it. Go to **Appearance > Themes** and activate your chosen theme.


Plugin Install
---------------

#### Required Plugin Installation 

The theme's functionality is broken up through the use of individual plugins. 
This way, if you ever decide to change themes, your site data like shortcodes or contact forms 
will continue to work on your new site.

1. Once you have activated the theme a plugin notification should appear, prompting you to install the required and recommended plugins. 
Follow the prompt and click **Begin installing plugins**
![Alt text](../wp-content/themes/struck/functions/includes/help/images/plugin-prompt.png)

2. On the following page click the checkbox next to **Plugin** in the header. This will select all plugins. 
Only the plugins marked "required" are required for theme functionality. The rest are completely optional.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/activate-plugin.png)

3. Next, select **Install** from the **Bulk Actions** dropdown and click **Apply** to finish the process. The plugins will automatically be activated.

#### Manual Plugin Install

If you've already installed the required plugins using the above directions, then you don't need to manually install the required plugins. 
However, if you've run into problems installing the theme's plugins, you can manually install them.

1. Navigate to **Plugins > Add New**. Click the **Upload Plugin** link and then select **Choose file**. 
You can find all the plugins in your theme download in the **struck/functions/plugins** folder. Be sure to choose the zip file to install the plugin.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/install-plugin.png)

2. Once you selected the correct file, click **Install Now**. 
The plugin will unpack, install, and then require activation. Select **Activate Plugin**. Your plugin is now activated.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/plugin-activate.png)


Page Setup 
---------------

After you install the theme you'll need to set up some page templates and a few options to get it running properly. 
There are several custom page templates included with this theme, which provides more flexibility and customization options. 

### Page Templates

See the list below for a brief explanation of the page templates included with this theme. For more information on customizing your theme using page templates see [Customizing Pages](#customization-customizing-pages) section of the theme help. 

> **Note:** Sections can be added to **any** page template. All sections will appear first on the page, before the content and page title area. For more information visit the [Sections](#adding-content-sections) portion of theme help.

Template Option             |Description
----------------------------|-------------------
**Default Template**        | Wordpress Default Page template with sidebar, which displays any widgets placed in "Page sidebar" area.
**Contact Page**   	        | Any optional sections added appear first, then contact page format will display. 
**Full Width Page**	        | A full width page that does not have a sidebar. Any optional sections will appear first before the page content and title.
**Posts - Classic**	        | This template will feature posts and portfolio items of your choosing. This template is also used for a portfolio page.
**Posts - Grid**		    | Displays posts and portfolio items in a grid type formate. This template is also used for a portfolio page.
**Posts - Minimal**	        | Minimal style that displays selected posts and portfolio items. This template is also used for a portfolio page..
**Regular No Sidebar Page** | Displays content at the same width as the default template, but centered and without a sidebar.
**Sections-only Page**	    | No page content will appear, the page is composed only of the sections and section slides that have been added. 

### Setting up the homepage

1. To set up the homepage you must create a new page. Navigate to **Pages > Add New**. You can give this page any title and you do not have to include any content.

2. For the homepage you can have any template you'd like. Select from list of template options listed in the Page Attributes section. 
To setup your website like the theme demo select the **Posts - Grid** template from the Page Attributes section. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/posts-grid.png)

3. Complete the optional **Page Title Options** and **Post Display Options**. Be sure to fill out the information on each tab. 
Once you've filled out all the information for the default homepage, click **Publish**.

4. Now that you have created your new page which uses a homepage template, navigate to **Settings > Reading** to configure the Front Page Displays setting.

5. Select the **A static page** radio button and choose the page you just created as your **Front page** and click **Save** to save the changes.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/front-page-displays.png)

> Your homepage is now created and can be viewed by visiting your root URL.

### Setting up the blog

1. To set up the blog page you must create a new page. Navigate to **Pages > Add New**. You can give this page any title and you do not have to include any content.

2. To setup the blog like the demo use the “default” template and the theme will take care of the rest. 
If you want to change the template of the blog page, Select from list of template options listed in the Page Attributes section.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/default-template.png)

3. Now that you have created your new page, navigate to **Settings > Reading** to configure the Front Page Displays setting.

4. Select the **A static page** radio button and choose the page you just created as your **Posts page** and click **Save** to save the changes.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/front-page-displays.png)

> Your blog page is now created and can be viewed by visiting the page you just published.

### Setting up the contact page

1. To set up the contact page you must first be sure the "Ninja Forms" plugin is activated. Navigate to **Forms > Import/Export**.

2. Click **Choose a File** and locate the **Content Import** folder in your theme download. Select **Struck-Contact.nff** and click **Import Form**.

3. To set up the contact page you must create a new page. Navigate to **Pages > Add New**. You can give this page any title and you do not have to include any content.

4. Select the **Contact Page** template from the Page Attributes section. This ensures your page will have the Contact Page sidebar. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/contact-page-attribute.png)

5. On the right side bar under **Append A Ninja Form** select **Contact** from the dropdown. Once you’ve selected the form, click **Publish** or **Update** to save.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/ninja-contact.png)

6. Now that you have created your new page which uses a contact form, make sure you have the correct information entered for your
 form by visiting **Forms > All Forms > Contact Form**.

> Your contact page is now created and can be viewed by visiting the page you just published

### Setting up the portfolio page

1. To set up the portfolio page you must create a new page. Navigate to **Pages > Add New**. You can give this page any title and you do not have to include any content.

2. Next navigate to the Page Attributes section on the right side of the page. To create a portfolio page you must assign the page one of the following templates: 
**Posts - Classic**, **Posts - Grid**, or **Posts - Minimal**.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/posts-minimal-attributes.png)

3. Next scroll down below the page content and locate the section **Post Display Options**. To create your portfolio page select the option **Portfolio Items** under Posts to Display. 

**Note: You can also display blog posts, featured items (both posts and portfolio items set as featured), or hand-picked items on portfolio pages.** 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/post-display-options.png)

4. Now you have created a portfolio page. To add portfolio items navigate to **Portfolio > Add New** and begin creating your portfolio items. 

> Your portfolio page is now created and can be viewed by visiting the page you just published

Menu Setup
--------------
Once you've added your pages you'll need to setup your main navigation menus. There are two menu locations with this theme. The **Top Nav Bar** which appears at the top of each page and the **Slideout Menu** which is initially hidden but expands from the right sidebar when the menu icon is clicked. You can create a different menu to display in each of these locations.

1. To set up the top bar or slideout menu mavigate to **Appearance > Menus** and enter the name of your menu in the text box provided. Click **Create Menu** to begin.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/create-menu.png) 

2. Add items to the menu by selecting from left column options panel. 
Add pages, link or categories by selecting the checkbox of the item and then clicking, **Add to Menu**.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/adding-menu-items.png)

3. Once items have been added to a menu, drag and drop to put them in the desired order. 
Drag a menu item to the right a little to make it a submenu item and create a hierarchy. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/menu-structure.png)

4. After your menu has been created be sure to set the location. This can be done the following two ways: 

From the same Edit Menus tab, under **Menu Settings**, select the checkbox **Top Nav Bar** or **Slideout Panel** menu (or both, if you'd like the menu you just created to show in both locations) for Theme Locations. 
Click **Save Menu** to save all recent changes made to your menu.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/menu-location.png)

Or under the tab **Manage Locations**, select the menu you've created from the dropdown list for  **Top Nav Menu** or **Slideout Panel** location. Or click **Use New Menu** to create a new menu for the desired location. Be sure to save any changes.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/manage-locations.png)

> Your navigation menu(s) now created and can be viewed by visiting any page.

Forms Setup
--------------
Create and manage custom forms for your widgets or pages.

#### Managing the Contact Form

To set up the Contact Form with your own information, visit **Forms > All Forms** and then select the one called Contact Form. 
Make sure you've already set up the Contact Page according to the steps outlined in Setting up the Contact Page under 
the [Page Setup](#getting-started-page-setup) section of Theme Help.

Once you have opened the Contact Form click the **Email & Actions** tab, then click **Email Admin**. In the **To** field, type in your email.
Feel free to explore additional options for forms by checking out the [Ninja Forms documentation](http://docs.ninjaforms.com/).

After completing the above as needed, click **Save Form Settings** to make sure the changes to your Contact Form have been saved.

Adding Content
==================

Once you've completed the initial set up you'll need to add content to your site. The following passages instruct you on how to add posts, images, widgets and sections. 
As always, if you have any questions not covered in this help file please visit our [Support Forum](http://support.themewich.com/discussions).

Sections
------------

Sections are flexible content areas you can use throughout your site. They can be added to any page, portfolio item, or post. 
Multiple sections can be added to the page and will appear one after the other before the page content.

There are four different types of Sections you can create, each with their own features and options. Below are explanations for each type of Section.

### Text and Image Section

This is a pre-designed section that can display a background image, background video, or background color with an (optional) text overlay. 
You can add buttons and additional images that can link to lightboxes, other pages on your website, or elsewhere. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/section-tabs.png)

#### Title tab

Option                      |Description
----------------------------|-------------------
**Subtitle**	            | Enter an optional subtitle, which appears smaller above the title. 
**Title** 		  	        | Enter an optional title for your section.
**Horizontal Layout**       | Choose whether the title(s) should be left, center, or right. Any image you add will display opposite of the text. 
**Vertical Alignment**      | Choose the vertical alignment for your titles from top, middle, or bottom.

#### Content tab

Option                      |Description
----------------------------|-------------------
**Content** 	   	        | Enter optional content for your section which appears below the title(s). The content can be edited using the same options as the WYSIWYG editor.

#### Button tab

Add an optional button, link, or play icon that links to a specified destination. 

Option              |Description
--------------------|-------------------
**Button Style**	| Choose between a regular button, an underlined link, or a play icon for your button styles.
**Button Text**		| Enter what you'd like your button text to be, such as "Learn More" or "Our Projects"
**Button Link**		| Select where the button will link to. The button can link to the next section, a custom URL, an already created page or post, or have the link open in a lightbox (such as a video or image).

#### Image tab

Add an optional image to your section. It will display opposite the title alignment set in the Title tab. Note: This is not a background image. 

Option          |Description
----------------|-------------------
**Image**		| Add an image or upload an existing one from your media library, it will align based on the settings chosen in the Title tab. Note: This is not the background image. 
**Image Link**	| Select whether the image should link to the full size in a lightbox, to a custom URL, or choose for the image not to be a link. 

#### Background tab

Option                  |Description
------------------------|-------------------
**Text Color**			| Depending on your background color/image choose whether the section text should appear white or black. 
**Background**			| Select a color, an image, or have a video for the section background.
**Background Color**	| For Color Background only. Use the selector to pick the color of your background.
**Overlay Color**		| For Video and Image backgrounds only. Choose a color for the overlay to make sure the text above it is readable. 
**Overlay Opacity**		| Enter a number to determine the opacity. Higher numbers will result in a more solid overlay. Lower numbers create a more translucent overlay.
**Background Image**    | Upload an image or select an existing one from your media gallery. 
**Video Type**			| Select between youtube or self hosted. Note: Youtube videos are a great option for shared hosting as they will use no bandwidth on your server. 
**Youtube URL**			| Enter the Youtube URL. Be sure to include http://
**Video Mp4 URL**		| Self Hosted only. Both of these formats are needed as different HTML5 enabled browsers support different formats.
**Video WebM URL**		| Self Hosted only. Both of these formats are needed as different HTML5 enabled browsers support different formats.
**Section Caption**     | A caption for your image or video that will appear in the bottom right corner in the text color determined above. 

#### Extras tab

Option                        |Description
------------------------------|-------------------
**Scroll Indicator Arrow**	    | Turn on/off the scroll indicator arrow that guides to the next section or page content below. 
**Animations**			        | Turn on/off the animation of the title/button/content when scrolling between sections.

### Text and Image Slides

Create multiple "Text and Image" sections with the options mentioned above and arrange them into a slide show.  The slides will appear in the given order by clicking left or right on the front end of your website. Slides wrap in a continuous loop, rather than end with the last slide of the section. 

Add a new slide by clicking **Add Slide** or the **+** sign. To delete a slide click the **-** sign of that given slide. Reorder the slides by clicking on the left side gray numbered area and dragging the slides into the order you want. The number indicates the first slide that will appear for the section. The additional slides following the first slide will appear to the right of the first slide.

![Alt text](../wp-content/themes/struck/functions/includes/help/images/section-slides.png)

> Note: You need at least two (2) slides for the slide section to function properly.

### Custom Section

A custom section is more flexible and allows you to add columns and other content to create unique sections. 
These sections still have many of the same options as the text and image section, but you can design the section how you like. 
Use the guidelines mentioned above in [Text and Image](#adding-content-sections-types-of-sections) section to fill out the tabs for your custom section.  
![Alt text](../wp-content/themes/struck/functions/includes/help/images/custom-section.png)

### Custom Slides

Custom slides follow the same format as custom sections, a flexible content section with background image, video, or color. 
Add, delete, and reorder slides according to the directions listed above under Text and Image Slides.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/custom-slides.png)

### Section Options

Option                          |Description
--------------------------------|-------------------
**AutoScroll**			        | Turn off/on the auto scrolling feature for instead of regular scrolling for these sections.
**Section Animations**		    | Choose whether you want animations when the visitor enters the sections.

Adding Sections
----------------

Add a new page, post, or portfolio item or navigate to an existing one where you'd like a section. At the top of the page 
you will need to enter a title for the post, portfolio item, or page. The title will appear below any sections you add, 
any content entered in the WYSIWYG editor will also appear below the sections. 

1. To add the first section select **Add Section** and then choose the type of section you'd like to add. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/add-section.png)

2. Begin customizing your section by filling out the required and optional fields listed below each tab. 
Be sure to visit each tab. Visit [Sections](#adding-content-sections-text-and-image-section) and 
[Section Options](#adding-content-sections-section-options) for more information on the specific fields. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/section-tabs.png)

3. Add more sections by clicking the **+** sign or **Add Section** button. Delete sections you no longer want by clicking the **-** sign of that section in the top right corner. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/adding-more-sections.png) 
If you have multiple sections you can change their order by dragging and dropping them into a new order. 
Simply hover over the gray section number and title area and click to drag the section to its new location. 
The numbers will indicate the order your sections will appear in on the front end.

Save or publish your changes by clicking **Save Draft**, **Publish**, or **Update** in the top right corner of the page. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/publish-save-draft.png) 

Adding Blog Posts
----------------- 

Be sure you've set up your blog according to the instructions highlighted in [Setting up the Blog](#getting-started-page-setup-setting-up-the-blog). 

To add a new blog post navigate to **Posts > Add New**. Enter the title, an optional intro title, post content, assign various categories, 
[add sections](#adding-content-adding-sections), and upload /insert images. 
Once you've created a new post be sure to **Save Draft** or **Publish**, in order to save the changes.

#### Post Title Options 

Write an optional **intro text** for your post. It will appear before the post content in a larger font and be given h2 tags for SEO purposes. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/post-title-options.png)

#### Featuring a Post

In the top right corner of the edit post page, under **Featured** you can select if you want to feature your post. 
Once you've selected posts to be featured, navigate to **Featured Order** from your main navigation menu and drop 
and drag the posts in the order you'd like them to appear.

Featured Posts appear on pages with special **Posts** templates that show featured posts. 
Visit [Posts Templates](#customization-customizing-pages-posts-template-options) to learn more about using templates 
to feature posts. 

![Alt text](../wp-content/themes/struck/functions/includes/help/images/featured-post.png)

#### Categories

Categories appear above the post title on the single post item page. Clicking on the category will open a 
blog archive showing all posts assigned with that same category. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/adding-categories.png)

#### Filters

Filters will appear on the front end of your website on the main blog index page. It allows multiple blog posts and 
portfolio items to be sorted via the given filters. Filters are optional and will not appear if you do not assign 
any to your blog posts. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/blogfilters-frontend.png) 

Add filters to your portfolio items under the right sidebar section **Filter**. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/add-filter.png)

#### Featured Image
Add an optional featured image for your blog post. The image will only appear on the main blog index page. 
This gives you the flexibility to display a different image on the blog index than the images shown in the blog's 
content or any added sections.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/set-featured-image.png)

#### Append a Ninja Form

Add an optional form to your blog post by selecting from the dropdown one you've already created. 
The form will appear below the sections and below the post content. See [Forms setup](#getting-started-forms-setup) for 
information on creating forms. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/append-ninja.png)


Adding Portfolio Items 
-----------------------
Before adding portfolio items be sure you set up the portfolio page according to the instructions explained in the 
[Setting up the Portfolio Page Section](#getting-started-page-setup-setting-up-the-portfolio-page).

To create a new portfolio item navigate to **Portfolio > Add New**. Enter the title, post content, 
[add sections](#adding-content-adding-sections), and insert images into the content area. Once you've created a new post be sure to **Save Draft** or **Publish**, in order to save the changes

#### Portfolio Title Options 

Option                              |Description
------------------------------------|-------------------
**Show Title**				        | Turn the title on or off for the portfolio item. This is useful if you only want to have sections for your portfolio item.
**Subheadline**				        | Add an optional Subheadline that will appear above the title
**Title Area Background Image**	    | Add an optional background image that will appear behind the title area of the portfolio item
**Intro Text**				        | Add optional intro text that will appear above the portfolio item content. 

#### Featuring a Portfolio Item

In the top right corner of the edit portfolio item page, under **Featured** you can select if you want to feature your
post. Once you've selected posts to be featured, navigate to **Featured Order** from your main navigation menu and 
drop and drag the post and portfolio items in the order you'd like them to appear.

Featured Portfolio Items appear on pages with special **Posts** templates. Visit 
[Posts Templates](#customization-customizing-pages-posts-template-options) to learn more about using templates to 
feature posts and portfolio items. 

#### Filters

Filters will appear on the front end of your website on the main portfolio index page when assigned. It allows 
multiple posts and portfolio items to be sorted via the given filters. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/filters-frontend.png)

Add filters to your portfolio items under the right sidebar section **Filter**. 
![Alt text](../wp-content/themes/struck/functions/includes/help/images/add-filter.png)

#### Featured Image
Add an optional featured image for your portfolio item. The image will only appear on the main portfolio index page. 
This gives you the flexibility to display a different image on the portfolio index than the images shown in the
 portfolio item's content or portfolio sections.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/set-featured-image.png)


Shortcodes
-----------

The theme comes with the Themewich Shortcodes plugin, which incldues a number of shortcodes allowing you to add styled 
content to your site with little effort. Shortcodes can embed files or create objects that would normally require lots 
of complicated code in just one line.

Conveniently, the available shortcodes have been included as buttons in the WYSIWYG content editor. When creating a page
or post, click the desired shortcode icon to insert your code. Simply hover over the buttons to see what shortcodes 
you’ll be inserting.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/shortcode-location.png)

>Be sure you have installed the Themewich Shortcode plugin by visiting the [Theme Plugins Install](#getting-started-plugin-install) section of the Theme Help.

### Accordion Shortcode

Add accordions your theme, a clickable region where only one section can be opened at a time. Add to any page, section or widget area. The accordion section MUST be wrapped in an accordion shortcode.

Parameters:				|Options:
------------------------|--------------
**title**               |Title of the accordion link
**class**				|Give it a class for advanced styling purposes

Example:

```html
[accordion]
[accordion_section title="Title"]Accordion Section Content Here.[/accordion_section]
[accordion_section title="Title"]Accordion Section Content Here.[/accordion_section]
[accordion_section title="Title"]Accordion Section Content Here.[/accordion_section]
[/accordion]
```

### Button Shortcodes

These button shortcodes allows you to insert a button into your content and can be linked to the destination URL of 
your choice.

Parameters:		|Options:
----------------|-----------------------------------
**size**		|Select the size of the button from `small`,`medium`,`large`.
**background**	|Enter an optional background color for the button.
**color**		|Select the color for the button, `gray`,`blue`,`red` etc. When left blank it uses the theme color.
**target**		|The button link `_blank` opens in a new window, `_self` opens in the same window.
**link**		|Enter the button link between.
**class**		|Give it a class for advanced styling purposes

Example:

```html
[tw-button size="large" background="#000000" color="gray" target="_blank" link="#"]Button[/tw-button]
[tw-button size="small" background="#000000" color="" target="_self" link="#"]Submit[/tw-button]
```

### Column Shortcodes

Column shortcodes give you the versatility of creating variable layouts on a page. You can break paragraphs, images, 
and even other shortcodes into columns of your chosing. Columns are also responsive, and will automatically format 
themselves for mobile viewing.
**Note: You must end each set of columns with a parameter position of last.**

Example:

```html
[tw-column width="one-half"] Insert you content here [/tw-column]
[tw-column width="one-half" position="last"] Insert you content here [/tw-column]
```
 
Parameters:				|Options:
------------------------|--------------
**width**				|The width of the columns, such as one-half,one-third,one-fifth etc.
**position**			|Enter a position of last, only for the final column in the set, see example above.
**class**				|Give it a class for advanced styling purposes

Columns go in halfs, thirds, fourths, fifths and sixths. You can mix and match column widths to create your own layouts. 
You just need to make sure the column widths add up to exactly one, and the last column of the row has 
`position="last"`.

**3 Column Example:**

```html
[tw-column width="one-third"]content[one_third]
[tw-column width="one-third"]content[one_third]
[tw-column width="one-third" position="last"]content[/tw-column]
```

**4 Column Example:**

```html
[tw-column width="one_fourth"]content[/tw-column]
[tw-column width="one_fourth"]content[/tw-column]
[tw-column width="one_fourth"]content[/tw-column]
[tw-column width="one-fourth" position="last"]content[/tw-column]
```

### Divider Shortcode

This shortcode lets you place a title divider anywhere. The divider will automatically match the width of it’s 
container. For instance, if you want a half-width divider, place it inside a one half column shortcode.

Parameters:				|Options:
------------------------|--------------
**class**				|Give it a class for advanced styling purposes

Example: 
```html
[divider]The Title Here[/divider]
```

### Lightbox Shortcode

A lightbox shortcode creates a link to a lightbox. The contents of the lightbox popup are indicated with the 
link="http://www.example.com".

Parameters:				|Options:
------------------------|--------------
**link**				|URL of the lightbox image or video 
**class**				|Give it a class for advanced styling purposes

Example:
```html
[lightbox link="http://www.example.com/image.jpg"]Link text or image here.[/lightbox]
```

Inline content Follows this form: 
```html
[lightbox link="#inline-content"]Link Text[/lightbox]
```

### Posts Shortcode

The posts shortcode allows you to display recent posts.

Parameters:				|Options:
------------------------|--------------
**title**				|Title displayed above posts (optional)
**number**			    |Number of posts
**category**            |Category to pull posts from (optional)
**content**             |Display the content below the title with a read more button (optional)
**type**                |Post type to get posts from (i.e. "portfolio" for portfolio posts)
**class**				|Give it a class for advanced styling purposes

Example:
```html
[tw-posts title="Title" number="4" category="reviews" content="yes" type=""][/tw-posts]
```

### Pricing Table Shortcode

The pricing table shortcode allows you to add pricing tables with a variety of layouts and options. A list can be added inside the table. List items are a great way to showcase features. `[pricing]` shortcodes must be wrapped in a `[pricing_table]` shortcode.

Parameters:				|Options:
------------------------|--------------
**size**				|Column size (i.e. one-half, one-third, or one-fourth)
**featured**			|Yes makes this shortcode box highlighted. No makes it grey.
**plan**                |Tiny text above the price
**cost**                |Large price in the shortcode box
**button_url**          |URL for the button to link to
**button_text**         |Text inside the button
**button_target**       |"self" for the same window, "blank" for a new window
**class**				|Give it a class for advanced styling purposes

Example:
```html
[pricing_table]
  [pricing size="one-half" featured="no" plan="Silver" cost="$10" per="month" button_url="#" button_text="Purchase" button_target="self"]
    <ul>
      <li>Feature</li>
      <li>Feature</li>
    </ul>
  [/pricing]
  [pricing size="one-half" position="last" featured="yes" plan="Gold" cost="$10" per="month"
  button_url="#" button_text="Purchase" button_target="self"]
    <ul>
      <li>Feature</li>
      <li>Feature</li>
    </ul>
  [/pricing]
[/pricing_table]
```

#### Social Icon Shortcode

Add elegant icon links to your favorite social networks.

Parameters:					|Options:
----------------------------|--------------------------------------------------
**icon**					|"twitter", "facebook", "google","dribbble", "linkedin" , "pinterest", and "rss"
**target**					|"blank" - Opens in a new window. "self" - Opens in the current window
**title**					|For hover and SEO purposes. Examples: "Follow Us", "Pin it" or "Like on Facebook"
**url** 					|Be sure this begins with http://
**class**					|Give a class to your social icon for advanced styling purposes

Example:
```html
[social icon="twitter" url="http://twitter.com/#" title="Follow Us" target="blank"][/social]
```

#### Tabs Shortcode

The featured tabs shortcode allows you to insert content into multiple featured tabs. The tabs can be viewed in by the user. You can include any number of tabs but you must ensure the number of titles and tabs match.

Parameters:					|Options:
----------------------------|--------------------------------------------------
**tab{number}**				|Title for each tab
**class**					|Give a class to your social icon for advanced styling purposes

Example:
```html
[tabs tab1="Tab 1 Title" tab2="Tab 2 Title" tab3="Tab 3 Title"]
[tab]Tab 1 Content[/tab]
[tab]Tab 2 Content[/tab]
[tab]Tab 3 Content[/tab]
[/tabs]
```

####   Toggle Shortcode
Add toggles to your theme, a clickable region where mulitple sections can be opened at a time. Add to any page, section or 
widget area.

Parameters:				|Options:
------------------------|--------------
**title**               |Title of the toggle link
**class**				|Give it a class for advanced styling purposes

Example:
```html
[toggle title="title"]Toggle Content Here.[/toggle]
[toggle title="title"]Toggle Content Here.[/toggle]
[toggle title="title"]Toggle Content Here.[/toggle]
```
#### Paralax Shortcode

A parallax image is the full width of the page and remains fixed on the page while the rest of the content scrolls above
and below it. Note: A parallax image should be at least 1500px wide to avoid excessive pixelation. Parallax will only 
work on pages without sidebars.

Parameters:					    |Options:
--------------------------------|--------------------------------------------------
**Background Image URL**		|Enter the url of the image you'd like to appear as your paralax
**Background Color**			|Enter an optional hex color value for a background color to overlay the image
**Image Opacity**				|Enter a numbered value to make the background color more opac. Higher value is less transparent. 
**Parallax Link**				|Enter a link for where you'd like the image to go to. 
**Link Target**				    |Decide if the link should open in a new window or the same window.
**Open Link in lightbox?**		|Decide if the image should open in a lightbox. 
**Headline**				    |Enter an optional headline to appear overtop the image
**Subheadline**				    |Enter an optional subheadline that will appear below the headline.

Example:
```html
[tw-parallax image="http://struck/wp-content/uploads/2015/yourimage.jpg" target="blank" ]

Headline

Subheadline

[/tw-parallax]
```
 
Widgets
----------
There are three custom Widgets along with the standard Widgets included with WordPress.

#### Adding Widgets

The widgets can be found under **Appearance > Widgets**. Widgets can be placed in the footer, and various sidebars on 
pages and sections. To activate a Widget in a sidebar or footer simply drag it to the desired area, or click the Widget, 
select a destination and click **Add Widget**.
![Alt text](../wp-content/themes/struck/functions/includes/help/images/widget-example.png)

Arrange the order of Widgets by clicking and dragging them it into place. You can customize the Widget features by 
clicking the down arrow in the upper right corner. Be sure to save any changes made to the Widget by clicking **Save**. 
To remove the Widget, click **Delete**.

Below are explanations for the Custom Widgets that are included with Struck.

### Custom News Widget

A Widget that allows you to display the most recent blog posts from a specific category.

Option			        |Description
------------------------|----------------------------------
**Title**			    |You can an optional title for the Widget.
**Number of Posts**	    |Enter the number of posts you'd like to display, it must be at least 1 and less than 10.
**Choose a Category**	|Select a specific category in which the posts are pulled

### Custom Menu Widget

A Widget that allows you to display custom menus. Visit [Menu Setup](#getting-started-menu-setup) for instructions on creating a custom menu. 

Option			        |Description
------------------------|----------------------------------
**Title**			    |You can an optional title for the Widget.
**Select Menu** 		|Select from your custom menus which one you'd like to display. 

### Custom Recent Portfolio Items Widget

A widget that displays small project thumbnails from recent portfolio items.

Option			        |Description
------------------------|----------------------------------
**Projects Title** 		|You can an optional title for the Widget.
**Number of Posts**		|Enter the number of posts you'd like to display, it must be at least 1 and less than 10.

### Ninja Forms Widget

A Widget that allows you to display custom forms such as a contact form. See the passage about creating [Custom Forms](#getting-started-forms-setup) for more information.

Option			        |Description
------------------------|--------------------------------
**Display Title**		|You can display the title for the Widget.
**Forms Dropdown**	    |Select the form you'd like to display in the Widget.

Customization 
==============

Struck is equipped with loads of features that allow you to customize your website. Use the following passages as a 
guide and if you need any help along the way check out our [Support Forum](http://support.themewich.com/discussions).

Customizing Pages
---------------------
The theme is equipped with several [page templates](#getting-started-page-setup-page-templates) that allow for 
flexibility of style and function. All the page templates have **Featured Image** and **Page Title** options located 
below the page content. Certain templates (**Posts - Minimal**, **Posts - Classic**, and **Posts - Grid**) have 
additional options that allow for even more flexibility. 

### Page Template Options
All Page templates have the following options listed below the content area, which allows you to customize the title 
section of the page. 

#### Featured Image

The featured image will appear behind the title and subtitle of the page. Remember, if you added any sections, those 
will appear before your page title and content.

#### Page Title Options 

Option                         	        |Description
----------------------------------------|-------------------
**Title Alignment**				        | Adjust the title so it appears to the left or in the center. 
**Subtitle**					        | Add an optional Subtitle that will appear below the title
**Title Area Background Color**		    | Select the background color that will appear behind the title area of the page. This acts as an overlay if you set a featured image as well.
**Title Area Background Color Opacity**	| Change the opacity of the background color. If you set a featured image be sure to adjust the opacity of the background color so it's visible. 
**Title Area Text Color**			    | Change the color of the text so that it will be visible against the background color/featured image. 

### Posts Template Options 

**Posts - Minimal**, **Posts - Classic**, and **Posts - Grid** templates allow you to display posts and portfolio items 
in a certain style on the page (such as a grid format, for example). With Posts - Templates you can showcase multiple 
posts or portfolio items in one place (such as the Homepage, for example).

Post Display Options        |Description
----------------------------|-------------------
**Posts to Display**        | Select which type of posts you'd like to display on the page. Featured Items are both Posts and Portfolio items that were set as featured. 
**Number of Posts Per Page**| Enter the number of Posts or Portfolio items you'd like to display on the page.  
**Filter**	   		        | Turn this on if you'd like any filters that have been set to appear on the page for sorting. 
 

#### Posts - Classic 

Options      		    |Description
------------------------|-------------------
**Post Alignment**      | Set the alignment of the posts for where they will appear on the page, either left or center.


#### Posts - Grid

Options      		    |Description
------------------------|-------------------
**Crop**      		    | Turn the cropping on to make all the grid items the same width and height. 
**Columns**      		| Decide between 2, 3, or 4 grid columns to appear on the page.
**Alignment**		    | Change the alignment of the filter items list.

#### Posts - Minimal

Options      		    |Description
------------------------|-------------------
**Post Alignment**      | Set the alignment of the posts for where they will appear on the page, either left or center.

Theme Customizer
----------------
Change the highlight color, navigation menu, tagline and adjust layout options using this tool.

Navigate to **Appearance > Theme Customizer** to open the Theme Customizer live preview and begin changing and 
customizing the look of your website. See below for descriptions on the various tools and features of the Customizer. 
Once you have made changes you would like to keep, click **Save & Publish**.

![Alt text](../wp-content/themes/struck/functions/includes/help/images/customizer-struck.png)

### Options and Features
Below are the descriptions for the various tools and features of the Theme Customizer.

#### Customize

Option                      |Description 										    
----------------------------|-----------------------------------------------------------------------------
**Header Layout**           | Select whether you want the header next to or below the logo.               
**Search Box Default Text** | Enter the text you'd like to appear in the search box, such as "Search...".

#### Updates

Enter your Themeforest username used to purchase this theme and your API key to get automatic theme updates. 

You can find your API key by Logging into Themeforest, visiting your Dashboard page then clicking the My Settings tab. At the bottom of the page you will find your account API key and a button to regenerate it as needed.

#### Site Title and Tagline

Option          |Description 					    
----------------|----------------------------------------------
**Site Title**  |Enter the title of your site here.		    
**Tagline**     |Enter an optional tagline for your site here. 

#### Colors

Option                |Description
----------------------|-------------------
**Highlight Color**   |Select the highlight color, i.e links and hovers, for your site.
**Background Color**  |The background color for your site content.
**Footer Color**      |The background color for the footer
**Footer Text Color** |The color of the footer text.
#### Navigation

Option              |Description
--------------------|-------------------
**Top Nav Bar**     |This menu location is located in the top right of your site. You can select a menu from already created Custom menus to set one as your main navigation menu.
**Slide Out Menu**  |This menu location is shown when you click the navigation icon in the upper right. You can select a menu from already created Custom menus to set one as your main navigation menu.

#### Static Front Page

Option                       |Description
-----------------------------|-------------------
**Front Page Displays**      |Select Your **latest posts** if you'd like your Homepage to be the blog, or select **Static Page** if you want a different page as the Homepage.
**Front Page**               |Select or change which page you'd like for you homepage.
**Posts Page**               |Select or change which page you'd like for the blog page.

> You may have already setup the Front and Posts Page displays during Page Setup

Theme Options
----------------

Use the Theme Options panel to customize layouts, add custom CSS, upload a logo, change the fonts, and adjust other 
theme settings.

After making changes to any of the following tabs be sure to click, **Save Changes**. To reset the changes of the 
specific tab you're currently viewing click, **Reset Section**, to reset all tabs in Theme Options click, **Reset All**.

#### General Settings

Option	            |Description
--------------------|--------------------
**Dark Logo**	    |Required. Click Upload to upload a dark colored logo to be shown on light backgrounds.
**Light Logo**	    |Required. Click Upload to upload a light colored logo to be shown on dark backgrounds.
**Retina Logo**     |Select **On** to half the size of your logo for HDPI displays.
**Favicon**	        |Upload your Favicon, the recommended size is 16px by 16px.
**Tracking Code**	|Paste in the Google Analytics or other tracking codes here. Be sure to include the `<script>` tags.

#### Customize
 
Option	                    |Description
----------------------------|--------
**Header Margin**	    	|Adjust the top and bottom margin pixels to choose the spacing want in your header.
**Search Box Default Text**	|Enter the default text you'd like to appear in your search box
**Footer Center Text**		|Enter any text or shortcodes you'd like to appear in your center footer. Center is the full width of the footer, appears above left and right footers.
**Footer Left Text**		|Enter any text or shortcodes to appear in the left footer. Such as [tw-current-year] or [tw-social icon="twitter" url="" title=""]
**Footer Right Text**		|Enter any text or shortcodes to appear in the right footer. Such as [tw-current-year] or [tw-social icon="twitter" url="" title=""]
**Ajax Loading Image**		|Choose the loading image you'd like to appear throughout your site. 
**Custom CSS**	            |Enter any custom CSS to your theme by entering it into the provided block.
**Custom Javascript**	    |Quickly add some custom javascript to your theme by adding it to this block.

#### Blog Settings

Option				      |Description
--------------------------|------------------
**Default Post Sharing**  |Choose whether or not to display sharing options which appear at the bottom of posts and portfolio items.

#### Fonts

These two tabs are where you'll change your font throughout the theme. You can also change the weight, making it bolder 
or less bold, and size of the font as well. Sections have their own fonts separate from the rest of the site. Use the 
button **Reset Section** if you'd like to undo any font changes and reset them to the theme's original.

#### Updates

Fill out the fields in this tab to get automatic theme updates

Option				        |Description
----------------------------|----------------
**Themeforest Username**	|Enter your Themeforest username used to purchase this theme.
**Themeforest API Key**		|You can find your API key by Logging into Themeforest, visiting your Dashboard page then clicking the My Settings tab. At the bottom of the page you will find your account API key and a button to regenerate it as needed.
**Your Version**			|Displays the current version of the theme you are using.

#### Advanced 

Option			        |Description
------------------------|---------------
**Use Ajax Page Load**  |This may need to be turned off to work with some plugins that won't work with ajax.
**Show Help Page**	    |Turn this off to hide the help page from the WordPress dashboard.
**Edit Custom Fields**	|Turn this on to edit custom fields used by the theme. BE SURE TO CREATE A BACKUP OF YOUR THEME AND DATABASE BEFORE CHANGING THIS.

#### Import / Export Options

Option			        |Description
------------------------|-----------
**Import Options** 	    |Once you've downloaded a copy you can re-import it here, should you ever lose your Theme Options.
**Export Options**	    |Here you can copy/download your current option settings. Keep this safe as you can use it as a backup should anything go wrong, or you can use it to restore your settings on this site (or any other site).

Frequently Asked Questions 
===========================

### What are Filters?

Filters work just like categories, only they are applied to both portfolio items and posts.
They allow these items to be sorted onscreen by the given filter. If you have a portfolio page, blog page, or you're using the 
[Posts - templates](#customization-customizing-pages-posts-template-options) to display posts and portfolio items then you can 
choose to use filters so they can easily to be sorted to display similar items.

### Where is the Homepage Template? 

This theme does not have a homepage template in order to make designing your website more versatile. For example, you 
could assign a contact page template as your homepage and add a number of sections and section slides to appear first before the contact form. 

In short, any [page template](#getting-started-page-setup-page-templates) can be the homepage, as long as you set it as such under **Settings > Reading** for the Front Page option.

Altering and Extending
======================

## Setting Up A Child Theme

By creating a child theme, you create a separate set of files that you can use to customize the theme without affecting 
the original theme. Not only does this make updating easier, it also makes sure that you will never ruin your original 
theme as you are never actually modifying the files. You can always turn off your child theme and fall back on the 
original.

#### Creating and using child theme
Whether you've made changes to the theme files already, or plan on making alterations, it's a good idea to create a 
child theme.

#### Adding additional CSS

Inside these child themes, you can see a stylesheet where you can add additional css styles to your theme. 

```css
/*
Theme Name: Struck Child Theme
Description: Child theme for Struck.
Author: Themewich
Template: struck
*/

@import url("../struck/style.css");

/* Add additional CSS here */
```

Simply add your custom css after the `@import` line and you're good to go!

#### Activating Your Child Theme

To use your child theme, be sure to zip it. Once it's zipped, you can 
[install it just like any other theme](#getting-started-installation). You'll notice that you can only activate the 
child theme while the correct parent theme is active.

#### Making Other Alterations and Additions

Adding additional CSS to the theme is great, but what if you want to edit some of the theme's template files, or add 
your own template files? 

This is where the magic of child themes come in. If you want to make a change to a specific PHP file in your parent 
theme, just copy the file and paste that copy into your child theme’s folder. Once you have the file into your child 
theme directory, you can edit away! WordPress automatically will use that file instead of the parent theme file as 
long as the child theme is activated. This method applies to creating new files as well.

**Important:** If you are copying files into your child theme, the file structure in your child theme should match 
your parent theme. For example, if you decide to edit a PHP file in 

```
/struck/functions/templates/sharing.php
```

you should place it in 

```
/struck/functions/templates/sharing.php
```

## Hooks and Filters

To make it easy to make alterations to the theme, we've set up a ton of hooks and filters you can use in your child theme
to change queries, disable features etc. Here's a giant list of all the hooks you can use with some examples to follow.
The general usage for these hooks looks like this:

```php
my_function( $data ) {
    // do some alterations to the data here
    // then return it
    return $data;
}
add_action( 'tw_section_classes', 'my_function' );
```


### Template Hooks

Template hooks allow you to add your own html content to the site via a child theme, without having to create child 
theme files. All the template hooks can be used in the following manner.

```php
function my_extra_html() {
    echo '<div class="note">Attention! Check me out!</div>';
}
add_action( 'tw_above_navigation', 'my_extra_html' );
```

Simply replace `tw_above_navigation` with the hook of your choice to change where the html will display.

Hook			                |Description
--------------------------------|-----------
**tw_above_navigation** 	    |Content to show up **above** the navigation.
**tw_below_navigation**	        |Content to show up **below** the navigation.
**tw_before_logo**              |Content to show up **before** the logo.
**tw_after_logo**               |Content to show up **after** the logo, but before the navigation.
**tw_before_nav_icon**          |Content to show up **before** the navigation icon, but after the top nav bar.
**tw_above_footer**             |Content to show up **above** the footer, and outside the footer content.
**tw_below_footer**             |Content to show up **below** the footer, and outside the footer content.
**tw_above_footer_content**     |Content to show up **above** the footer, and inside the footer content.
**tw_below_footer_content**     |Content to show up **below** the footer, and inside the footer content.

### Section Hooks

Section hooks allow you to alter section functionality via a child theme. You can add section or slide classes, ids, or 
inline styles. 

Example:
```php
my_function( $array ) {
    // do some alterations to the data    
    $array[] = 'another-value';
    
    // then return it
    return $array;
}
add_action( 'tw_section_classes', 'my_function' );
```

Sometimes you'll want to only alter a specific section on a specific page. You can do that by getting the id from the 
public `$post` variable of the page along with detecting the section number on that page.
                                     
Example:
```php
function my_extra_class( $classes ) {
	global $post;

	// only add class if the page id is 2 and we are on the second section
	if ( $post->ID == 2 && in_array( "section-2", $classes ) ) {
		$classes[] = 'an-extra-class';
	}

	return $classes;
}

add_action( 'tw_section_classes', 'my_extra_class' );
```

#### tw_section_classes

Add additional classes to a section. 

Example: 
```php
function my_extra_class( $classes ) {
    $classes[] = 'an-extra-class';
    return $classes;
}
add_action( 'tw_section_classes', 'my_extra_class' );
```

#### tw_slide_classes

Add additional classes to a slide. 

Example: 
```php
function my_extra_slide_class( $classes ) {
    $classes[] = 'an-extra-class';
    return $classes;
}
add_action( 'tw_slide_classes', 'my_extra_slide_class' );
```

#### tw_section_ids

Add additional ids to a slide. 

Example: 
```php
function my_section_id( $ids ) {
    $ids[] = 'an-extra-id';
    return $ids;
}
add_action( 'tw_slide_ids', 'my_section_id' );
```
 

#### tw_slide_ids

Add additional ids to a slide. 

Example: 
```php
function my_slide_id( $ids ) {
    $ids[] = 'an-extra-id';
    return $ids;
}
add_action( 'tw_slide_ids', 'my_slide_id' );
```

#### tw_section_styles

Add additional styles to a section. 

Example: 
```php
function my_section_style( $styles ) {
    $styles[] = 'an-extra-id';
    return $styles;
}
add_action( 'tw_section_styles', 'my_section_style' );
```

#### tw_slide_ids

Add additional styles to a slide. 

Example: 
```php
function my_slide_style( $styles ) {
    $styles[] = 'an-extra-id';
    return $styles;
}
add_action( 'tw_slide_styles', 'my_slide_style' );
```

### Post/Portfolio Query Hooks

Posts and portfolios use queries to get post info from the database. Using these hooks you can alter the query loops to
change them to your liking.

> All loops are stored in transients to reduce the number of calls to the database. If you plan on altering the loops,
be sure to turn off the transients momentarily or you won't see the changes take effect on your front end.

Example:
```php
// turn of the portfolio transient so we can see our modifications
function tw_remove_portfolio_transient() {
    return false; // turn it off
}
add_action( 'tw_portfolio_transient', 'tw_remove_portfolio_transient' );
```

#### tw_portfolio_transient

Turn on/off the portfolio transient.

Example:
```php
// turn of the portfolio transient so we can see our modifications
function tw_remove_portfolio_transient() {
    return false; // turn it off
}
add_action( 'tw_portfolio_transient', 'tw_remove_portfolio_transient' );
```

#### tw_portfolio_query

Change the portfolio query. Below is an example of adding posts to the page with an id of 341.

Example:
```php
// turn of the portfolio transient so we can see our modifications
function tw_remove_portfolio_transient( $loop ) {
	return false;
}
add_action( 'tw_portfolio_transient', 'tw_remove_portfolio_transient' );

// lets get recent posts and portfolio items
function tw_change_portfolio_query( $args ) {
	global $post;

	// we are only changing it for page 341
	if ( $post->ID == 341 ) {
		$args['post_type'] = array( 'portfolio', 'post' ); // add posts too
		$args['orderby']   = 'date'; // Turn off drag/drop order
		$args['order']     = 'DESC'; // Newest first
	}

	return $args;
}
add_action( 'tw_portfolio_query', 'tw_change_portfolio_query' );

```

#### tw_featured_transient

Turn on/off the featured loop transient.

Example:
```php
// turn of the portfolio transient so we can see our modifications
function tw_remove_featured_transient() {
    return false; // turn it off
}
add_action( 'tw_featured_transient', 'tw_remove_featured_transient' );
```

#### tw_featured_query

Change the featured query. Below is an example of removing the featured order and displaying posts in order of date on 
page 341.

Example:
```php
// turn of the featured transient so we can see our modifications
function tw_remove_featured_transient( $loop ) {
	return false;
}
add_action( 'tw_featured_transient', 'tw_remove_featured_transient' );

// lets get recent posts and featured items
function tw_change_featured_query( $args ) {
	global $post;

	// we are only changing it for page 341
	if ( $post->ID == 341 ) {
		$args['orderby']   = 'date'; // Turn off drag/drop order
		$args['order']     = 'DESC'; // Newest first
	}

	return $args;
}
add_action( 'tw_featured_query', 'tw_change_featured_query' );

```

#### tw_posts_transient

Turn on/off the posts transient.

Example:
```php
// turn of the posts transient so we can see our modifications
function tw_remove_posts_transient() {
    return false; // turn it off
}
add_action( 'tw_posts_transient', 'tw_remove_posts_transient' );
```

#### tw_posts_query

Change the posts query. Below is an example of adding portfolio items to the page with an id of 341.

Example:
```php
// turn of the posts transient so we can see our modifications
function tw_remove_posts_transient( $loop ) {
	return false;
}
add_action( 'tw_posts_transient', 'tw_remove_posts_transient' );

// lets get recent posts and posts items
function tw_change_posts_query( $args ) {
	global $post;

	// we are only changing it for page 341
	if ( $post->ID == 341 ) {
		$args['post_type'] = array( 'portfolio', 'post' ); // add posts too
		$args['orderby']   = 'date'; // Turn off drag/drop order
		$args['order']     = 'DESC'; // Newest first
	}

	return $args;
}
add_action( 'tw_posts_query', 'tw_change_posts_query' );

```

### Filter Hooks

Filter hooks allow you to change the filter functionality on index pages.

#### tw_term_filters

Change the filters on the portfolio page. Below is an example of removing a filter list on a page with an id of 341.

Example:
```php
function tw_change_filter_terms( $filters ) {
	global $post;

	// we are only changing it for page 341
	if ( $post->ID == 341 ) {
		$key = array_search( 12, $filters );
		unset( $filters[ $key ] );
	}

	return $filters;
}

add_action( 'tw_term_filters', 'tw_change_filter_terms' );
```

Theme Files 
============
This section discloses the sources of various files used within the theme and describes their function. Use this section to gain an understanding on how the theme functions behind the scenes if considering any type of modification.

>  **Child Theme Recommended**
>
>It's recommended that you use a child theme for any type of modifications to the theme. A child theme allows you to
>make modifications to the theme without editing the theme's files. Using a child theme ensures you can still update 
>the theme without losing your changes. 
>[More about child themes on the knowledgebase.](http://support.themewich.com/kb/updating-your-theme/how-to-update-without-losing-your-changes)

Basic Structure
-------------------

This template is a responsive layout built upon “Media Queries”. The CSS uses “media queries” to size specific content areas and other elements depending on browser width. Refer to the media queries section at the end of style.css for more information.

#### CSS Files and Structure

> **Always put your css changes in your custom css box or a child theme whenever possible.** That way, if you ever update your theme, you won’t lose your changes. However, if you have to edit the theme directly I’ve put all styles in one main stylesheet to allow for easier changes.

Stylesheet Name		    |Description
------------------------|-------------
**style.css**		    |Used for the specific styling of elements, layout and typography throughout the site. In this file you can find the styles of any of the elements throughout the site, such as buttons, image frames, sliders, featured tabs, forms, quotes and more.
**bootstrap.css**		|A reponsive grid framework for the site.
**font-awesome.css**	|Scalable vector icons.
**ie9.css**			    |Styles to make compatbile with Internet Explorer 9

#### Use of SCSS Files
You can also make use of the scss files included in the sass folder of the theme. For more information about scss files, check out the Sass Website.

#### Javascript
This theme imports multiple Javascript files that are required to view the theme sections and other functionality.

Here are some scripts worth noting:

Script Name		  |Description
------------------|-------------
**imageloaded**   |Detects if images are loaded in a container. This is needed for infinite scroll and graceful page rendering.
**ajaxify**       |The theme uses a custom version to make each page load via ajax.
**bxslider**      |Used for the gallery slideshows throughout your site.
**easing**        |A utility function to help ease animations in a more natural way.
**fitvids**       |Makes videos responsive with the screen width.
**fullpage**      |A slightly modified version of fullpage for the section functionality
**history**       |Used for the ajax scripts and to move to the correct section when clicking the back button
**infinitescroll**|Allows each page of posts to be loaded via ajax.
**magnificpopup** |Theme lightbox for images, videos, inline content and iframes.
**navburger**     |Custom plugin created by Themewich for the slide out menu. Uses tweenmax(greensock) for animation.
**slimscroll**    |Allows fullpage sections to be scrolled if the content exceeds the height of the window.
**modernizer**    |Browser feature detection
**pace**          |Loading bar at the top of the site
**pace-options**  |Loading bar options needed to be included before pace call
**superfish**     |Top menu dropdowns
**tweenmax**      |Greensock animation platform. Requires special license to distribute.

Theme Plugins
-----------------

The theme's functionality is broken up through the use of individual plugins. This way, when if you ever decide to change themes, your site data, like shortcodes, contact forms or sections will continue to work on your new site.

Plugin Name				        |Description
--------------------------------|-------------
Advanced Custom Fields Pro 	    |Fully customise WordPress edit screens with powerful fields. Allows easier user modification of custom fields on sections and page options.
Ninja Forms				        |Ninja Forms is a webform builder that allows you to easily and quickly design complex forms through a drag and drop interface and absolutely no code.
Themewich Shortcodes		    |A better, more user-friendly shortcode plugin.
Themewich Portfolio Items	    |Portfolio Items post type for your Themewich theme.

#### Recommended Plugins 

Plugin Name						            |Description
--------------------------------------------|-------------
Category Order and Taxonomy Terms Order	    |Order Categories and all custom taxonomies terms (hierarchically) using a Drag and Drop Sortable javascript capability. 
Regenerate Thumbnails 				        |Allows you to regenerate all thumbnails after changing the thumbnail sizes.
Redux Framework					            |Redux is a simple and fully responsive options framework for WordPress themes and plugins
ZenCache						            |ZenCache takes a real-time snapshot (building a cache) of every Page, Post, Category, Link, to reduce your sever load by caching php requests. 
Better WordPress Minify                     |Allows you to combine and minify your CSS and JS files to improve page load time.
WordPress SEO					            |The first true all-in-one SEO solution for WordPress, including on-page content analysis, XML sitemaps and much more.


> **But wait! Won't all these plugins slow down my site?**
>
>This is a myth about WordPress commonly misspoken about running a lot of non-scalable, intensive plugins on your site. If plugins are quality,
>scalable plugins - they will not slow down your site. In fact, many of the top WordPress internet blogs run 50 - 100 plugins on their sites. 
>The plugins included with this theme were integrated with the theme in such a way so they are infinitely scalable, and won't slow down your site.
>In fact, many of these plugins will actually speed up your site!
>
>Check out these links for more information about using plugins: 
>[Plugins and Fast WordPress Sites](http://wpengine.com/2013/08/28/plugins-and-fast-wordpress-sites-its-not-the-number-of-plugins-its-the-quality/), [How Many Is Too Many Plugins?](https://lorelle.wordpress.com/2012/09/27/how-many-is-too-many-wordpress-plugins/), [How Many Plugins Should You Install On Your Site](http://www.wpbeginner.com/opinion/how-many-wordpress-plugins-should-you-install-on-your-site/)
 

#### Thank You!
Thanks again for purchasing my theme. If you have any questions that are beyond the scope of this help, please feel free ask any questions on the online [Support Forum](http://support.themewich.com/discussions). Thanks so much!
