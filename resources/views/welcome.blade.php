<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Zain Fresh | Grocery Store</title>
  <style>
    :root {
      --primary: #188A35;
      --primary-dark: #0f6d29;
      --accent: #F26522;
      --accent-dark: #d95316;
      --bg: #f8fcf7;
      --white: #ffffff;
      --text: #222222;
      --muted: #666666;
      --card: #ffffff;
      --border: #e7eee4;
      --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      --radius: 18px;
      --max-width: 1200px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      scroll-behavior: smooth;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.6;
    }

    img {
      max-width: 100%;
      display: block;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    .container {
      width: min(92%, var(--max-width));
      margin: auto;
    }

    .btn {
      display: inline-block;
      padding: 14px 24px;
      border-radius: 999px;
      font-weight: 700;
      transition: 0.3s ease;
      border: none;
      cursor: pointer;
    }

    .btn-primary {
      background: var(--primary);
      color: var(--white);
      box-shadow: var(--shadow);
    }

    .btn-primary:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
    }

    .btn-secondary {
      background: var(--accent);
      color: var(--white);
      box-shadow: var(--shadow);
    }

    .btn-secondary:hover {
      background: var(--accent-dark);
      transform: translateY(-2px);
    }

    .section-title {
      text-align: center;
      margin-bottom: 14px;
      font-size: 2rem;
      color: var(--primary-dark);
    }

    .section-subtitle {
      text-align: center;
      color: var(--muted);
      max-width: 700px;
      margin: 0 auto 50px;
    }

    /* HEADER */
    header {
      position: sticky;
      top: 0;
      z-index: 1000;
      background: rgba(255,255,255,0.92);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid #eef3ec;
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 14px 0;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .logo img {
      width: 75px;
      height: 75px;
      object-fit: contain;
      border-radius: 12px;
      background: #fff;
    }

    .logo-text h1 {
      font-size: 1.3rem;
      color: var(--primary-dark);
      line-height: 1.1;
    }

    .logo-text span {
      font-size: 0.9rem;
      color: var(--accent);
      font-weight: bold;
    }

    nav ul {
      display: flex;
      list-style: none;
      gap: 28px;
      align-items: center;
    }

    nav ul li a {
      font-weight: 600;
      color: #333;
      transition: 0.3s;
    }

    nav ul li a:hover {
      color: var(--primary);
    }

    .menu-toggle {
      display: none;
      font-size: 28px;
      cursor: pointer;
      color: var(--primary-dark);
      font-weight: bold;
    }

    /* HERO */
    .hero {
      padding: 80px 0 50px;
      background:
        radial-gradient(circle at top right, rgba(242,101,34,0.12), transparent 22%),
        radial-gradient(circle at top left, rgba(24,138,53,0.12), transparent 28%);
    }

    .hero-wrap {
      display: grid;
      grid-template-columns: 1.1fr 0.9fr;
      align-items: center;
      gap: 40px;
    }

    .hero-text h2 {
      font-size: 3rem;
      line-height: 1.15;
      color: var(--primary-dark);
      margin-bottom: 18px;
    }

    .hero-text h2 span {
      color: var(--accent);
    }

    .hero-text p {
      color: var(--muted);
      max-width: 600px;
      margin-bottom: 28px;
      font-size: 1.05rem;
    }

    .hero-buttons {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      margin-bottom: 28px;
    }

    .hero-features {
      display: flex;
      gap: 22px;
      flex-wrap: wrap;
      color: var(--primary-dark);
      font-weight: 700;
    }

    .hero-card {
      background: var(--white);
      border-radius: 30px;
      padding: 30px;
      box-shadow: var(--shadow);
      position: relative;
      overflow: hidden;
      border: 1px solid var(--border);
    }

    .hero-card::before {
      content: "";
      position: absolute;
      width: 180px;
      height: 180px;
      background: linear-gradient(135deg, rgba(24,138,53,0.1), rgba(242,101,34,0.15));
      border-radius: 50%;
      top: -50px;
      right: -40px;
    }

    .produce-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
      position: relative;
      z-index: 1;
    }

    .produce-item {
      background: #f8fcf7;
      border: 1px solid var(--border);
      border-radius: 20px;
      padding: 22px 16px;
      text-align: center;
      box-shadow: 0 6px 14px rgba(0,0,0,0.04);
    }

    .produce-item .emoji {
      font-size: 2.4rem;
      margin-bottom: 8px;
    }

    .produce-item h4 {
      color: var(--primary-dark);
      margin-bottom: 6px;
    }

    .produce-item p {
      font-size: 0.9rem;
      color: var(--muted);
    }

    /* ABOUT */
    section {
      padding: 80px 0;
    }

    .about-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
      align-items: center;
    }

    .about-box {
      background: var(--card);
      border-radius: var(--radius);
      padding: 34px;
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
    }

    .about-box h3 {
      color: var(--primary-dark);
      font-size: 1.8rem;
      margin-bottom: 16px;
    }

    .about-box p {
      color: var(--muted);
      margin-bottom: 14px;
    }

    .about-points {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
    }

    .point {
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 20px;
      text-align: center;
    }

    .point .icon {
      font-size: 1.8rem;
      margin-bottom: 10px;
    }

    .point h4 {
      color: var(--primary-dark);
      margin-bottom: 6px;
    }

    .point p {
      color: var(--muted);
      font-size: 0.95rem;
    }

    /* CATEGORIES */
    .cards {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 22px;
    }

    .card {
      background: var(--card);
      border-radius: var(--radius);
      padding: 28px 22px;
      border: 1px solid var(--border);
      box-shadow: var(--shadow);
      transition: 0.3s ease;
      text-align: center;
    }

    .card:hover {
      transform: translateY(-8px);
    }

    .card .icon {
      font-size: 3rem;
      margin-bottom: 12px;
    }

    .card h3 {
      color: var(--primary-dark);
      margin-bottom: 8px;
    }

    .card p {
      color: var(--muted);
      font-size: 0.95rem;
    }

    /* WHY US */
    .why-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
    }

    .why-item {
      background: linear-gradient(180deg, #ffffff, #f5fbf4);
      padding: 26px 20px;
      border-radius: var(--radius);
      text-align: center;
      border: 1px solid var(--border);
      box-shadow: var(--shadow);
    }

    .why-item .icon {
      width: 64px;
      height: 64px;
      margin: 0 auto 14px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      background: rgba(24,138,53,0.12);
      color: var(--primary-dark);
      font-size: 1.6rem;
      font-weight: bold;
    }

    .why-item h4 {
      margin-bottom: 8px;
      color: var(--primary-dark);
    }

    .why-item p {
      color: var(--muted);
      font-size: 0.95rem;
    }

    /* CONTACT */
    .contact-wrap {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 28px;
    }

    .contact-info,
    .contact-form {
      background: var(--card);
      padding: 30px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
    }

    .contact-info h3,
    .contact-form h3 {
      color: var(--primary-dark);
      margin-bottom: 18px;
      font-size: 1.6rem;
    }

    .info-item {
      margin-bottom: 16px;
      color: #444;
    }

    .info-item strong {
      color: var(--primary-dark);
      display: inline-block;
      min-width: 95px;
    }

    form {
      display: grid;
      gap: 14px;
    }

    input,
    textarea {
      width: 100%;
      padding: 14px 16px;
      border-radius: 12px;
      border: 1px solid #d9e4d6;
      outline: none;
      font-size: 1rem;
    }

    input:focus,
    textarea:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(24,138,53,0.12);
    }

    textarea {
      min-height: 130px;
      resize: vertical;
    }

    /* FOOTER */
    footer {
      background: #103f1f;
      color: #dce8dc;
      padding: 30px 0 20px;
      margin-top: 40px;
    }

    .footer-wrap {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      align-items: center;
      flex-wrap: wrap;
    }

    .footer-links {
      display: flex;
      gap: 18px;
      flex-wrap: wrap;
    }

    .footer-links a:hover {
      color: #fff;
    }

    /* RESPONSIVE */
    @media (max-width: 992px) {
      .hero-wrap,
      .about-grid,
      .contact-wrap {
        grid-template-columns: 1fr;
      }

      .cards,
      .why-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .hero-text h2 {
        font-size: 2.3rem;
      }
    }

    @media (max-width: 768px) {
      .menu-toggle {
        display: block;
      }

      nav {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #fff;
        border-top: 1px solid #edf2ea;
        display: none;
      }

      nav.active {
        display: block;
      }

      nav ul {
        flex-direction: column;
        padding: 20px;
        gap: 18px;
      }

      .cards,
      .why-grid,
      .about-points {
        grid-template-columns: 1fr;
      }

      .hero {
        padding-top: 50px;
      }

      .hero-text h2 {
        font-size: 2rem;
      }

      .logo img {
        width: 60px;
        height: 60px;
      }
    }
  </style>
</head>
<body>

  <header>
    <div class="container navbar">
      <a href="#" class="logo">
        <img src="https://www.genspark.ai/api/files/s/Q4AmXgn3" alt="Zain Fresh Logo">
        <div class="logo-text">
          <h1>Zain Fresh</h1>
          <span>Fresh Grocery Store</span>
        </div>
      </a>

      <div class="menu-toggle" id="menu-toggle">&#9776;</div>

      <nav id="nav-menu">
        <ul>
          <li><a href="#home">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#products">Products</a></li>
          <li><a href="#why">Why Us</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="#contact" class="btn btn-secondary">Order Now</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="hero" id="home">
    <div class="container hero-wrap">
      <div class="hero-text">
        <h2>Fresh Grocery for a <span>Healthy Lifestyle</span></h2>
        <p>
          Welcome to Zain Fresh, your trusted place for fresh fruits, vegetables, and quality daily grocery essentials. We focus on freshness, affordability, and friendly service.
        </p>

        <div class="hero-buttons">
          <a href="#products" class="btn btn-primary">View Products</a>
          <a href="#contact" class="btn btn-secondary">Contact Us</a>
        </div>

        <div class="hero-features">
          <span>✔ Fresh Daily</span>
          <span>✔ Best Quality</span>
          <span>✔ Affordable Price</span>
        </div>
      </div>

      <div class="hero-card">
        <div class="produce-grid">
          <div class="produce-item">
            <div class="emoji">🍊</div>
            <h4>Fresh Fruits</h4>
            <p>Healthy and juicy seasonal fruits.</p>
          </div>
          <div class="produce-item">
            <div class="emoji">🍅</div>
            <h4>Vegetables</h4>
            <p>Farm-fresh vegetables every day.</p>
          </div>
          <div class="produce-item">
            <div class="emoji">🥬</div>
            <h4>Leafy Greens</h4>
            <p>Clean and fresh green produce.</p>
          </div>
          <div class="produce-item">
            <div class="emoji">🥭</div>
            <h4>Daily Essentials</h4>
            <p>Simple grocery items for your home.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="about">
    <div class="container">
      <h2 class="section-title">About Zain Fresh</h2>
      <p class="section-subtitle">
        We provide fresh groceries with a focus on quality, cleanliness, and customer satisfaction.
      </p>

      <div class="about-grid">
        <div class="about-box">
          <h3>Your Neighborhood Fresh Grocery Store</h3>
          <p>
            Zain Fresh is dedicated to delivering high-quality fruits, vegetables, and grocery essentials for families who value freshness and trust.
          </p>
          <p>
            Our goal is simple: offer clean, fresh, and affordable products with reliable service every day.
          </p>
          <a href="#contact" class="btn btn-primary" style="margin-top: 10px;">Get in Touch</a>
        </div>

        <div class="about-points">
          <div class="point">
            <div class="icon">🌿</div>
            <h4>Fresh Daily</h4>
            <p>Products selected with freshness in mind.</p>
          </div>
          <div class="point">
            <div class="icon">💚</div>
            <h4>Quality First</h4>
            <p>We care about healthy and clean food.</p>
          </div>
          <div class="point">
            <div class="icon">🚚</div>
            <h4>Fast Service</h4>
            <p>Quick support for your grocery needs.</p>
          </div>
          <div class="point">
            <div class="icon">💰</div>
            <h4>Best Prices</h4>
            <p>Affordable groceries for everyone.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="products">
    <div class="container">
      <h2 class="section-title">Our Products</h2>
      <p class="section-subtitle">
        Explore our simple grocery categories designed for an informational store website.
      </p>

      <div class="cards">
        <div class="card">
          <div class="icon">🍎</div>
          <h3>Fresh Fruits</h3>
          <p>Apples, oranges, mangoes, bananas, and seasonal fruits.</p>
        </div>
        <div class="card">
          <div class="icon">🥕</div>
          <h3>Vegetables</h3>
          <p>Tomatoes, carrots, onions, potatoes, and more fresh vegetables.</p>
        </div>
        <div class="card">
          <div class="icon">🥬</div>
          <h3>Leafy Greens</h3>
          <p>Spinach, lettuce, coriander, mint, and other greens.</p>
        </div>
        <div class="card">
          <div class="icon">🛒</div>
          <h3>Daily Grocery</h3>
          <p>Basic home essentials and daily-use grocery products.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="why">
    <div class="container">
      <h2 class="section-title">Why Choose Us</h2>
      <p class="section-subtitle">
        We make grocery shopping easy, fresh, and dependable.
      </p>

      <div class="why-grid">
        <div class="why-item">
          <div class="icon">1</div>
          <h4>Fresh Products</h4>
          <p>We focus on product quality and freshness every day.</p>
        </div>
        <div class="why-item">
          <div class="icon">2</div>
          <h4>Affordable Rates</h4>
          <p>Good groceries at prices that fit your household budget.</p>
        </div>
        <div class="why-item">
          <div class="icon">3</div>
          <h4>Clean Handling</h4>
          <p>Proper care and clean presentation of all produce.</p>
        </div>
        <div class="why-item">
          <div class="icon">4</div>
          <h4>Friendly Support</h4>
          <p>Easy communication for inquiries and product details.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <h2 class="section-title">Contact Us</h2>
      <p class="section-subtitle">
        Have questions or want to place an order inquiry? Reach out anytime.
      </p>

      <div class="contact-wrap">
        <div class="contact-info">
          <h3>Store Information</h3>
          <div class="info-item"><strong>Phone:</strong> +123 456 7890</div>
          <div class="info-item"><strong>Email:</strong> info@zainfresh.com</div>
          <div class="info-item"><strong>Address:</strong> Your Grocery Store Address Here</div>
          <div class="info-item"><strong>Hours:</strong> Mon - Sun | 8:00 AM - 10:00 PM</div>
          <div class="info-item"><strong>WhatsApp:</strong> +123 456 7890</div>
        </div>

        <div class="contact-form">
          <h3>Send a Message</h3>
          <form>
            <input type="text" placeholder="Your Name" required>
            <input type="email" placeholder="Your Email" required>
            <input type="text" placeholder="Subject">
            <textarea placeholder="Write your message here..."></textarea>
            <button type="submit" class="btn btn-secondary">Send Message</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container footer-wrap">
      <p>© <span id="year"></span> Zain Fresh. All rights reserved.</p>
      <div class="footer-links">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#products">Products</a>
        <a href="#contact">Contact</a>
      </div>
    </div>
  </footer>

  <script>
    const toggle = document.getElementById("menu-toggle");
    const nav = document.getElementById("nav-menu");

    toggle.addEventListener("click", () => {
      nav.classList.toggle("active");
    });

    document.getElementById("year").textContent = new Date().getFullYear();
  </script>

</body>
</html>
