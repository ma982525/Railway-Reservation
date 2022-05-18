# Railway Reservation
 This application is a simple demonstration of Railway Reservation System where we can search for train from particular location to another location on particular date.
 
 We can view intermediate trains, distance, and we calculate cost of ticket according to the distance.
 
 At max we can add 6 travellers while booking at a single time.
 
 Trains data are manually added from backend in database directly, no admin console is there as of now.
 
 Searching and sorting are done in an optimal way to reduce time while fetching intermediate trains and data.
 
 No Payment Integration is attached yet or no train classes added. This is a simple represention of the system.
 
 Visit System at: http://railwayreservationclone.42web.io
 
 # Login
![image](https://user-images.githubusercontent.com/54614262/169036439-e5fdad6c-8b7a-4b1d-bfcd-9f03eac8f76a.png)

# Home Page
![image](https://user-images.githubusercontent.com/54614262/169036717-7a037d93-7018-46e5-8287-96ffc00354d6.png)

# Search Screen
![image](https://user-images.githubusercontent.com/54614262/169036953-5b38e6fb-584a-4604-acbf-aecc6af9af58.png)

# Train Detail Screen
![image](https://user-images.githubusercontent.com/54614262/169037077-6875f5f6-35a5-4e50-b487-29c079e0a8d5.png)

# Book Screen
![image](https://user-images.githubusercontent.com/54614262/169037312-b63ad66e-f3a3-4ca3-bfba-cb4dac8177cc.png)
![image](https://user-images.githubusercontent.com/54614262/169038525-45ac99fa-7e64-436b-9403-de27300c47fb.png)


# Booking History Screen
![image](https://user-images.githubusercontent.com/54614262/169038138-0ad619b8-e853-4a67-8a7c-8fc50e6b87b0.png)


# Files details

index.php is our home page which needs user to login first to explore other things.

login/signup is interconnected and accessed from navigation

On index.php search train form is given which redirects to showTrains.php page

showTrains.php page shows all trains from one city to another on particular date.

View details of a particular train opens ViewDetails.php page which shows intermediate stations details.

From showTrains.php and ViewDetails.php we can click on book ticket which redirects to BookPage.

In BookPage adding Traveller details are added using a function there and updates all details there.

When clicks on book, booking_Handle.php handles the booking and redirects to bookingHistory.php page.

bookingHistory.php page shows upcomming & past booking details.

Upcomming Bookings are cancelled from bookingHistory.php page. When cancel button clicked CancelBooking_handle.php page handles the request and send back to bookingHistory.php page.

In common/navigation.php navbar file is given which is used in all files.


# Thankyou...
Happy Learning!
