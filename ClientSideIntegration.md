# Example Search Box HTML code with default values set to Restaurants in Montreal #

```
<form method="get" action="http://www.yoursitename.com/praized/merchants/search">
 <label>
  <input onfocus="this.value = '';"  id="search_keywords" name="q" size="30"  
  value="Restaurants" type="text">
 </label>
 <label>
  <input id="search_location" name="l" size="30" value="Montreal, QC" type="text">
 </label>
 <input value="Search" type="submit">
</form>
```

# Example Javascript Widget Code for Restaurants in Montreal, QC #

```
<div id="yoursitename_praized_widget">
 <script src="http://static.praized.com/praized-com/javascripts/widgets/snarl/0_2/widget.js" type="text/javascript" charset="utf-8">
  {key: 'yourapikey',slug: 'yoursiteslug',title:'Whatever Title you like',
  term: "restaurant",city: "Montreal,QC"}
 </script>
</div>
```

# CSS classes for (X)HTML integration of the Praized Plugins #

All html/xhtml elements generated from the Praized plugins have style classes for easier customization. Here a list of CSS classes found in style.css, colors.css and vote\_button.css (all prefixed with "praized" to prevent clashes with existing stylesheets your site or blog). Default values are provided in the stylesheets provided in the initial plugin download, this is just a quick list to give you an idea of what's possible.

You can take a peek at some default CSS files at http://beta-tribe.com/wp-content/themes/wordpraized/style.css and http://beta-tribe.com/wp-content/themes/wordpraized/styles/black/color.css the default theme, WordPraized is available here on Google Code at http://code.google.com/p/praized/downloads/detail?name=wordpraized.1.0.zip

```

.praized-add-to-favorites

.praized-add-to-favorites,.praized-add-to-favorites

.praized-add-to-favorites button:hover

.praized-user.vcard h2

.praized-user.vcard dl

.praized-user.vcard dd,.praized-user.vcard dt

.praized-user.vcard dt

.praized-user.vcard dd,.praized-user.vcard dd

.praized-user .praized-add-to-friends,.praized-user .praized-add-to-friends

.praized-user .praized-add-to-friends button

.praized-user-section ul

.praized-user-section li

.praized-user-section .praized-inline-merchant b.praized-value

.praized-user-section .praized-inline-merchant

.praized-user-section .praized-inline-merchant b.praized-value .praized-nominator

.praized-user-section .praized-inline-merchant b.praized-value .praized-denominator

.praized-user-section .praized-inline-merchant b.praized-value .praized-separator

.praized-user-section .praized-merchant-address

.praized-user-friends

.praized-merchants-list

.praized-add-tags

.praized-merchant-section p

.praized-pagination

.praized-pagination

.praized-pagination a

.praized-pagination .current

.praized-pagination .disabled,.praized-pagination .separator

.praized-add-tags,.praized-user .praized-add-to-friends button

.praized-merchants-list .praized-merchant-item

.praized-user-section li

.praized-inline-merchant b.praized-value

.praized-inline-merchant .pos b.praized-value

.praized-inline-merchant .neg b.praized-value

.praized-pagination a:hover

.praized-pagination .current

.praized-pagination .disabled,.praized-pagination .separator

.praized-pagination a

.praized-vote-button

html body .praized-vote-button,html body .praized-vote-button div,html body .praized-vote-button fieldset,html body .praized-vote-button abbr,html body .praized-vote-button legend,html body .praized-vote-button span,html body .praized-vote-button button,html body .praized-vote-button abbr

html body .praized-vote-button legend

html body .praized-vote-button fieldset.stats

html body .praized-vote-button fieldset.stats div.score

html body .praized-vote-button fieldset.stats .separator

html body .praized-vote-button fieldset.stats .separator,html body .praized-vote-button fieldset.stats .total

html body .praized-vote-button fieldset.stats span

html body .praized-vote-button abbr

html body .praized-vote-button button.vote-option

html body .praized-vote-button button.vote-for

html body .praized-vote-button button.vote-against

html body .praized-vote-button.novotes

html body .praized-vote-button.novotes fieldset.stats,html body .praized-vote-button.error fieldset.stats,html body .praized-vote-button.loading fieldset.stats

html body .praized-vote-button button.vote-for:hover,html body .praized-vote-button.voted-pos button.vote-for

html body .praized-vote-button button.vote-against:hover,html body .praized-vote-button.voted-neg button.vote-against

html body .praized-vote-button.loading

html body .praized-vote-button.error

```