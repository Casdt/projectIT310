<!-- navbar.php -->
<style>
    .navbar {
        background-color: #537D5D;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .navbar a {
        color: #ffffff;
        text-decoration: none;
        font-weight: 500;
        margin: 0 15px;
        font-size: 16px;
    }

    .navbar a:hover {
        text-decoration: underline;
    }

    .navbar .nav-left {
        display: flex;
        align-items: center;
    }

    .navbar .nav-right {
        display: flex;
        align-items: center;
    }

    .logout-simple {
        background-color: #73946B;
        color: #ffffff;
        padding: 8px 90px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.3s;
        margin-right: 200px;
    }

    .logout-simple:hover {
        background-color: #5a7d5d;
    }
</style>

<div class="navbar">
    <div class="nav-left">
        <a href="students.php">Students</a>
        <a href="aboutus.php">About Us</a>
    </div>
    <div class="nav-right">
        <a href="logout.php" class="logout-simple">Logout</a>
    </div>
</div>
