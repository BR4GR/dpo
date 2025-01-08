# Migros Scraper Project – Automating Product Data Extraction

**Project URL:** [GitHub Repository](https://github.com/BR4GR/wdb_Web-Daten-beschaffung)  
**Tech Stack:** Python, Beautiful Soup, Requests, MongoDB, PostgreSQL, Docker, Poetry  
**Category:** Web Scraping, Data Engineering

## Overview
The Migros Scraper Project is a web scraping and data processing application designed to collect product information from the Migros online store. The project saves the scraped data in both MongoDB (NoSQL) and PostgreSQL (SQL). Saving it to SQL is beneficial because the data is already parsed and filtered. Saving it to MongoDB provides an easy way to store all available information, allowing for future enhancements or additional parsing as needed.

## Features
- **Comprehensive Data Extraction**  
  The scraper navigates through various product categories on the Migros website, extracting detailed product information, including names, prices, descriptions, discounts, and more.

- **Dual Database Storage**  
  Implements storage of scraped data in both MongoDB and PostgreSQL, leveraging the strengths of each database type for flexible data handling and analysis.

- **Dockerized Environment**  
  Utilizes Docker and Docker Compose to create isolated environments for development, testing, and production, ensuring consistency across different stages of deployment and operating systems.

- **Automated Testing**  
  Includes unit and integration tests to ensure the reliability and accuracy of the scraping process and data storage mechanisms.

- **Error Handling and Logging**  
  Incorporates robust error handling with detailed logging to manage exceptions and maintain transparency during the scraping process.

## Challenges and Solutions
Web scraping dynamic websites like Migros can be challenging due to frequent changes in website structure and potential anti-scraping measures. This project addresses these challenges by:
- **Adaptive Parsing**  
  Employing flexible parsing techniques to accommodate changes in HTML and JSON structures.

- **Rate Limiting**  
  Implementing delays between requests to mimic human browsing behavior and avoid beeing blocked.

- **Modular Design**  
  Structuring the codebase to allow easy updates and maintenance when website changes occur.

## Use Cases
- **Market Analysis**  
  Aggregating product data for pricing comparisons and trend analysis.

- **Inventory Monitoring**  
  Tracking product availability and stock levels over time.

- **Data Enrichment**  
  Enhancing datasets with detailed product information for research or business intelligence purposes.

## Why I Built This
This project reflects my interest in data engineering and automation. By developing a tool to extract and store data from a major retailer like Migros, I aimed to create a resource that could be used for various analytical purposes, while also honing my skills in web scraping, database management, and containerization.

## Future possible Enhancements
- **Dashboard**  
  Where one could filder for different categories or products, and observe its changes over time. 

- **Data Cleaning and Normalization**  
  Adding processes to clean and normalize data for improved quality and consistency.

- **Scalability Improvements**  
  Optimizing the scraper to handle larger volumes of data and additional websites.

Feel free to explore the [GitHub repository](https://github.com/BR4GR/wdb_Web-Daten-beschaffung) for detailed documentation and source code.