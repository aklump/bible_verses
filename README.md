#Summary
A PHP solution for organizing Bible verses into collections, using
external APIs to provide the text.

##Configuration
* Copy `config.default.php` to `config.php`
* pages/our-father.txt has been provided as an example; you may build as many collections (pages) as you'd like
* Create a file inside of pages called, `our-father.txt`
* Then, enter the passages you would like to display one per line into  `our-father.txt`
* Visit the `/our-father` and you'll see the page
* Make sure cache has server write permissions
* Add headings (one per line) to the document using markdown syntax where, h1 = #Heading 1, h2 = ##Heading 2, etc.

##Styling
* Modify custom.css as needed; do not modify `includes/stylesheets/style.css`

##API
* Extend Bible class as needed for correct translation
* Add your class extensions inside `config.php`

##Contact
In the Loft Studios

Aaron Klump - Web Developer

PO Box 29294 Bellingham, WA 98228-1294

aim: theloft101

skype: intheloftstudios

[http://www.InTheLoftStudios.com](http://www.InTheLoftStudios.com)
