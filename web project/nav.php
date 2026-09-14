<!-- navbar.php -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* Neon Navbar */
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.navbar {
    background: #0a0a0a;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 0 15px #00f7ff;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.logo {
    color: #00f7ff;
    font-size: 22px;
    font-weight: bold;
    text-shadow: 0 0 10px #00f7ff;
    display: flex;
    align-items: center;
    gap: 10px;
}

.nav-links {
    display: flex;
    gap: 25px;
}

.nav-links a {
    color: #ffffff;
    text-decoration: none;
    font-size: 16px;
    padding: 8px 16px;
    border-radius: 8px;
    position: relative;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Modern Pill hover effect */
.nav-links a:hover {
    color: #00f7ff;
    background: rgba(0, 247, 255, 0.1);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 247, 255, 0.2);
}
</style>

<div class="navbar">

    <div class="logo">
        <i class="fas fa-search-location"></i> FIND YOUR THINGS...     
    </div>

    <div class="nav-links">
        <a href="user.php"><i class="fas fa-home"></i> Home</a>
        <a href="page2.php"><i class="fas fa-exclamation-circle"></i> Report Lost</a>
        <a href="page2a.php"><i class="fas fa-hand-holding"></i> Report Found</a>
        <a href="page4.php"><i class="fas fa-list"></i> Lost Items</a>
        <a href="page4a.php"><i class="fas fa-clipboard-list"></i> Found Items</a>
        <a href="review.php"><i class="fas fa-star"></i> Review</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

</div>