﻿# nutrtionalWebApp

The Nutritional WebApp is a web-based tool that allows users to generate for various meals and recipes using the Spoonacular API. With this application, users can easily discover a wide range of meal options based on their preferences and dietary requirements.

## Features

- **Generation of Meals:** Users can generate their desired meals  from the Spoonacular API.
- **Display of Results:** The application presents search results in an organized manner, showing meal titles and summaries to help users make informed choices.
- **API Integration:** The application seamlessly integrates with the Spoonacular API to fetch up-to-date meal data and ensure accurate search results.
- **User-Friendly Interface:** The application provides a user-friendly interface that is intuitive and easy to navigate, enhancing the overall user experience.
- **Customization:** Users can refine their search queries based on specific dietary preferences; such as: BMI and health condition(diabetes).

## Installation

1.Download and install XAMPP: Visit the Apache Friends website (https://www.apachefriends.org/index.html) and download the appropriate version of XAMPP for your operating system. Follow the installation instructions provided by XAMPP.

2.Clone or download the PHP application: Clone the repository of the PHP application from the version control system (such as Git) or download the application's source code in a zip file and extract it to a directory of your choice.

3.Move the application files: Copy or move the PHP application files to the "htdocs" directory within the XAMPP installation directory. The "htdocs" directory is the document root for the web server.

4.Start XAMPP: Launch the XAMPP control panel and start the Apache server. Make sure the Apache server is running without any errors.

5.Set up the database (if required): If the PHP application uses a database, open the XAMPP control panel and start the MySQL server. Use a database management tool such as phpMyAdmin (accessible through XAMPP) to create the required database and import any necessary SQL dump files provided with the application.

Table Design
There are four tables in the application. The tables form the backbone
of the database schema by structuring data in way that the application can store
and retrieve information about their users, meals and diary entries in an organized
manner.
Users Table
• userId(PK)
• userName
• userEmail
• userPassword
• userAge
• userLocation
• createDateTime
• status
UserProfile Table
• profileId(PK)
• userId(FK)
• userAge(FK)
• profileHeight
• profileWeight
• profileGender
• profileHealthConditions
• profileBmi
Meals Table
17
• mealsId(PK)
• profileId(FK)
• mealTitle
• mealImageType
• mealReadyInMinutes
• mealServings
• mealSourceUrl
• mealCreatedAt
Diary Table
• diaryId(PK)
• userId(FK)
• diaryHeadline
• diaryMsg
• diaryCreateDateTime



6.Configure application settings: The PHP application may require configuration settings specific to your environment. Check if there are any configuration files or setup instructions provided with the application and follow them to set up the necessary configurations, such as database connection settings or API keys.

7.Access the application: Open your web browser and visit "http://localhost" or "http://localhost:port" (replace "port" with the appropriate port number if you customized it during XAMPP installation). This will display the XAMPP default page. To access your PHP application, navigate to "http://localhost/your-application-directory" or "http://localhost:port/your-application-directory" (replace "your-application-directory" with the actual directory name where you placed the PHP application files).

## Usage

1. Obtain an API key from the Spoonacular API website.
2. Set the API key in the `meals.php` file.
3. Start the application.
4. Rgister your account.
5. Update your profile by entering your height, weight and health condition.
6. Go the generate meals module and it will automatically genearate meal plans for you.
7. Explore the meals results in the `My Plans` module and click on `view recipe` to view more details.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgements

The Nutritional WebApp utilizes the Spoonacular API for meal data and is built with php, html, Javascript, CSS and Bootstrap.
