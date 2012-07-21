# GrabzIt Codeigniter API library

GrabzIt service makes it possible to take screenshots of websites.  

## Installation

Register on the [GrabzIt](http://grabz.it/register.aspx?returnurl=http%3a%2f%2fgrabz.it%2fapi) site, and get the API keys.

If you use this package in conventional way, then copy the files to their appropriate folders, copy "vendor" folder into the application folder, then set up the config file.

Installing this package as spark:

    php tools/spark install -v1.0.0 Grabzit    

## Usage

Define the input parameters:

    $params = array(
       'www.yoursite.com', // site url
       'yoursite.jpg', 	// image filename
       NULL, 		// $custom_id 
       NULL, 		// $browserWidth 
       NULL, 		// $browserHeight
       NULL, 		// $width - width of the generated image
       NULL, 		// $height - height of the generated image
       NULL, 		// $format - the file format 
       NULL                // $delay - milliseconds before the screenshot being taken
    );  

    $this->load->library('Grabzit');

Fire the grab_image() method with the $params array:
    
    $result = $this->grabzit->grab_image($params);
    var_dump($result);

## Return values

If all went good, an image will be generated in the folder you set in config file, and you get back the unique ID of the screenshot. This can be used to get the screenshot with the get_picture() method.  
If not, you'll have a nice error message.  

## Other methods

You can find other methods on [GrabzIt Client Description](http://grabz.it/api/php/grabzitclient.aspx) page. Of course you have to use underline syntax eg. GetStatus() is get_status()..  

## Notes

With the free licence you can generate only 200 X 200 px images, and in .jpg format, with a watermark.  

## License

[MIT License](http://www.opensource.org/licenses/MIT)

C. 2012 Barna Szalai (sz.b@devartpro.com)