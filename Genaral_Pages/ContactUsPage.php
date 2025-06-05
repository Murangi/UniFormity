<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | UniFormity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .half-page {
            display: flex;
            height: 100vh;
        }

        .contact-image {
            background-image: url('../Images/BeautifulOfficeBuilding.jpg'); /* Change to your contact image */
            background-size: cover;
            background-position: center;
            flex: 1;
        }

        .contact-form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background-color: #f8f9fa;
        }

        .contact-form {
            width: 100%;
            max-width: 500px;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .contact-info {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .contact-info p {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>

<div class="half-page">
    <!-- Left: Image -->
    <div class="contact-image"></div>

    <!-- Right: Contact Form -->
    <div class="contact-form-container">
        <div class="contact-form">
            <h2 class="form-title">Contact Us</h2>

            <form method="post" action="ContactUsPage.html">
                <div class="mb-3">
                    <label for="username" class="form-label">Name</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Your full name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="admin@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message here..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Send Message</button>
            </form>

            <div class="contact-info">
                <h5>Contact Information</h5>
                <p><strong>Phone:</strong> +27 11 350 7777</p>
                <p><strong>Email:</strong> admin@gmail.com</p>
                <p><strong>Address:</strong> 44 Glen Austin, Midrand, Johannesburg</p>
                <p class="mt-2"><strong>Business Hours:</strong> Mon-Fri: 9:00 AM - 5:00 PM</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>