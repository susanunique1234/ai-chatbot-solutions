CREATE TABLE users(

    id SERIAL PRIMARY KEY,

    name VARCHAR(150) NOT NULL,

    email VARCHAR(150) UNIQUE NOT NULL,

    password TEXT NOT NULL,

    role VARCHAR(50) DEFAULT 'admin',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE services(

    id SERIAL PRIMARY KEY,

    title VARCHAR(255) NOT NULL,

    description TEXT NOT NULL,

    image TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE projects(

    id SERIAL PRIMARY KEY,

    title VARCHAR(255) NOT NULL,

    description TEXT NOT NULL,

    image TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE blogs(

    id SERIAL PRIMARY KEY,

    title VARCHAR(255) NOT NULL,

    description TEXT NOT NULL,

    image TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE gallery(

    id SERIAL PRIMARY KEY,

    title VARCHAR(255),

    image TEXT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE events (

    id SERIAL PRIMARY KEY,

    title VARCHAR(255),

    description TEXT,

    event_date DATE,

    image VARCHAR(255),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE feedback(

    id SERIAL PRIMARY KEY,

    customer_name VARCHAR(255),

    rating INTEGER,

    comment TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE contact_messages (

    id SERIAL PRIMARY KEY,

    name VARCHAR(255) NOT NULL,

    email VARCHAR(255) NOT NULL,

    phone VARCHAR(50),

    company_name VARCHAR(255),

    country VARCHAR(150),

    job_title VARCHAR(255),

    job_details TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE admin_logs(

    id SERIAL PRIMARY KEY,

    action TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);