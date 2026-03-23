<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link <?= $page != 'home' ? 'collapsed' : '' ?>" href="<?= base_url.'admin' ?>">
        <i class="bi bi-grid"></i><span>Dashboard</span>
      </a>
    </li>

    <li class="nav-heading">Management</li>
    <!-- Items -->
    <li class="nav-item">
        <a class="nav-link <?= $page != 'items' ? 'collapsed' : '' ?>" href="<?= base_url.'admin/?page=items' ?>">
            <i class="bi bi-question-octagon"></i><span>Items</span>
        </a>
    </li>
    <!-- Claims -->
    <li class="nav-item">
        <a class="nav-link <?= $page != 'claims' ? 'collapsed' : '' ?>" href="<?= base_url.'admin/?page=claims' ?>">
            <i class="bi bi-shield-check"></i><span>Claims</span>
        </a>
    </li>
    <!-- Categories -->
    <li class="nav-item">
        <a class="nav-link <?= $page != 'categories' ? 'collapsed' : '' ?>" href="<?= base_url.'admin/?page=categories' ?>">
            <i class="bi bi-tags"></i><span>Categories</span>
        </a>
    </li>
    <!-- FAQs -->
    <li class="nav-item">
        <a class="nav-link <?= $page != 'faqs' ? 'collapsed' : '' ?>" href="<?= base_url.'admin/?page=faqs' ?>">
            <i class="bi bi-question-circle"></i><span>FAQs</span>
        </a>
    </li>

    <li class="nav-heading">Administration</li>
    <!-- Users -->
    <li class="nav-item">
        <a class="nav-link <?= $page != 'user' ? 'collapsed' : '' ?>" href="<?= base_url."admin?page=user" ?>">
            <i class="bi bi-people"></i><span>Users Registry</span>
        </a>
    </li>
    <!-- Messages & Comms -->
    <li class="nav-item">
        <a class="nav-link <?= $page != 'messages' ? 'collapsed' : '' ?>" href="<?= base_url."admin?page=messages" ?>">
            <i class="bi bi-chat-dots"></i><span>Inbox</span>
        </a>
    </li>
    <!-- Broadcasts -->
    <li class="nav-item">
        <a class="nav-link <?= $page != 'notifications' ? 'collapsed' : '' ?>" href="<?= base_url."admin?page=notifications" ?>">
            <i class="bi bi-broadcast"></i><span>Broadcasts</span>
        </a>
    </li>

    <li class="nav-heading">Analytics & Security</li>
    <!-- Reports -->
    <li class="nav-item">
        <a class="nav-link <?= $page != 'reports' ? 'collapsed' : '' ?>" href="<?= base_url."admin?page=reports" ?>">
            <i class="bi bi-graph-up"></i><span>Reports</span>
        </a>
    </li>
    <!-- Feedback -->
    <li class="nav-item">
        <a class="nav-link <?= $page != 'feedback' ? 'collapsed' : '' ?>" href="<?= base_url."admin?page=feedback" ?>">
            <i class="bi bi-star"></i><span>Feedback</span>
        </a>
    </li>
    <!-- Audit Logs -->
    <li class="nav-item">
        <a class="nav-link <?= $page != 'audit_logs' ? 'collapsed' : '' ?>" href="<?= base_url."admin?page=audit_logs" ?>">
            <i class="bi bi-shield-lock"></i><span>Audit Logs</span>
        </a>
    </li>

    <li class="nav-heading">System Config</li>
    <!-- Settings -->
    <li class="nav-item">
        <a class="nav-link <?= $page != 'system_info' ? 'collapsed' : '' ?>" href="<?= base_url."admin?page=system_info" ?>">
            <i class="bi bi-gear"></i><span>Settings</span>
        </a>
    </li>
  </ul>
</aside>