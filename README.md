# Shorter Links

Yes it's another shorter links, I tried to leave it as simple as possible so as to make it usable and understandable by as many people as possible.



---



#### Live Demo:

You can test the it on [THIS SITE](https://ed0.it/sl)!

![ShorterURL_test.gif](demo/ShorterURL_test.gif)

---



#### Features:

- Same output in case of same input link

- Possibility to create almost 100 million short links (99795696 to be precise)

- Checks on user input:

- - The user must actually enter a valid URL

  - The URL entered must be at least 22 characters (protocol included) otherwise it would be shorter than the exit short link



---



#### Prerequisites:

- PHP

- A site (obviously)

- A database (I use MySQL)



---



#### Installation:

1. Create a database with a table called *"associations"* with this schema:

   | code      | link      | data      |
   | --------- | --------- |:---------:|
   | varchar() | varchar() | timestamp |

   ```sql
   CREATE TABLE `associations` (
     `code` varchar(20) DEFAULT NULL,
     `link` varchar(1000) DEFAULT NULL,
     `data` timestamp NULL DEFAULT CURRENT_TIMESTAMP
   );
   ```

2. Edit **index.php** with the database login credentials you just created

3. Replace in the various files the word *"xx.xx"* with your site, in my case it was *"ed0.it"*

4. Insert the **.htaccess** and **redirect.php** into the site root

5. Create a sub folder called *sl*

6. Insert the **index.php**, **result** and **style.css** into the sub folder *sl*

7. That's all folks!



---



#### Donation:

> ***Buy me a coffee*** *(PayPal)*:    [Ed0ardo](https:///paypal.me/ed0ardo)

> ***Buy me a coffee*** *(Binance Pay)*:    268880867

> ***Buy me a coffee*** *(Binance Wallet)*:    0x2a895d54c5249349a27183139d5975aa3518d573

> ***Buy me a coffee*** *(Trust Wallet)*:    0x825fFeB482BE713eA3bFea0F3B8c398813B65269

> ***Buy me a coffee*** *(CashApp)*:    $Ed0ardo
