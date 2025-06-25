<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | UniFormity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
            background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
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
            color: #0d6efd;
        }

        .contact-info {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .contact-info p {
            margin-bottom: 0.5rem;
        }

        @media (max-width: 1024px) {
            .contact-image {
                display: none !important;
            }
            .contact-form-container {
                flex: 1 1 100%;
                max-width: 100vw;
                padding: 2rem 1rem;
                align-items: center;
                justify-content: center;
            }
            .half-page {
                flex-direction: column;
                min-height: 100vh;
            }
        }
        @media (max-width: 768px) {
            .contact-form {
                max-width: 100vw;
                padding: 1rem;
            }
        }
        
        /* Custom modal styles */
        .success-modal .modal-content {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }
        
        .success-modal .modal-header {
            background: #0d6efd;
            color: white;
            border-bottom: none;
            padding: 20px 25px;
        }
        
        .success-modal .modal-body {
            padding: 30px;
            text-align: center;
        }
        
        .success-icon {
            font-size: 4rem;
            color: #0d6efd;
            margin-bottom: 20px;
        }
        
        .success-modal .btn-close {
            filter: invert(1);
        }
        
        .success-modal .btn-primary {
            background: #0d6efd;
            border: none;
            padding: 8px 25px;
            border-radius: 30px;
            font-weight: 500;
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

            <form id="contactForm" method="post" action="ContactUsPage.php">
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

                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-paper-plane me-2"></i>Send Message
                </button>
            </form>

            <div class="contact-info">
                <h5>Contact Information</h5>
                <p><strong>Phone:</strong> +27 11 350 7777</p>
                <p><strong>Email:</strong> admin@gmail.com</p>
                <p><strong>Address:</strong> 44 Herold Street, Austin, New York</p>
                <p class="mt-2"><strong>Business Hours:</strong> Mon-Fri: 9:00 AM - 5:00 PM</p>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade success-modal" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Success!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4 class="mb-3">Message Sent Successfully!</h4>
                <p>Thank you for contacting us. We'll get back to you soon.</p>
                <button type="button" class="btn btn-primary mt-3" data-bs-dismiss="modal">Continue</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Form validation would go here in a real application
            
            // Show the success modal
            successModal.show();
            
            // Reset the form
            form.reset();
        });
    });
</script>
</body>
</html>