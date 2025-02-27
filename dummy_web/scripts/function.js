// Make a pop up window function
function create_window(image, width, height)
{
    //Add some pixels to the width and height
    width = width + 10;
    height = height + 10;

    //If the window is already open, resize it to the new dimensions
    if(window.popup && !window.popup.closed)
    {
        window.popup.resizeTo(width, height);
    }

    //Set the window properties
    var specs = "location=no, scrollbars=no, menubar=no, resizable=yes, left=0, top=0, width=" +width+ ",height=" +height;

    //set the url
    var url = "show_image.php?image=" + image;

    //create the popup window
    popup = window.open(url, "ImageWindow", specs);
    popup.focus();
}