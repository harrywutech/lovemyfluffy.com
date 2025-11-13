<?php
/**
 * Sidebar Template
 * LoveMyFluffy Pet Supplies Theme
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar">
    <div class="sidebar-content">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside>

<style>
.sidebar {
    margin-top: 2rem;
}

.sidebar-content {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.widget {
    margin-bottom: 2rem;
}

.widget:last-child {
    margin-bottom: 0;
}

.widget-title {
    color: #2c3e50;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #ff6b9d;
}

.widget ul {
    list-style: none;
    padding: 0;
}

.widget ul li {
    margin-bottom: 0.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #f0f0f0;
}

.widget ul li:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.widget ul li a {
    color: #666;
    text-decoration: none;
    transition: color 0.3s ease;
}

.widget ul li a:hover {
    color: #ff6b9d;
}

.widget p {
    color: #666;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .sidebar {
        margin-top: 1rem;
    }

    .sidebar-content {
        padding: 1.5rem;
    }
}
</style>