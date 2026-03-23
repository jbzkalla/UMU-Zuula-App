<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link <?= $page != 'home' ? 'collapsed' : '' ?>" href="<?= base_url.'user' ?>">
        <i class="bi bi-grid"></i><span>Dashboard</span>
      </a>
    </li>

    <li class="nav-heading">My Items</li>
    <li class="nav-item">
      <a class="nav-link <?= $page != 'report_lost' ? 'collapsed' : '' ?>" href="<?= base_url.'user/?page=report_lost' ?>">
        <i class="bi bi-file-earmark-plus"></i><span>Report Lost Item</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= $page != 'report_found' ? 'collapsed' : '' ?>" href="<?= base_url.'user/?page=report_found' ?>">
        <i class="bi bi-search"></i><span>Report Found Item</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= $page != 'my_reports' ? 'collapsed' : '' ?>" href="<?= base_url.'user/?page=my_reports' ?>">
        <i class="bi bi-card-list"></i><span>My Reports</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= $page != 'my_claims' ? 'collapsed' : '' ?>" href="<?= base_url.'user/?page=my_claims' ?>">
        <i class="bi bi-shield-check"></i><span>My Claims</span>
      </a>
    </li>

    <li class="nav-heading">Communication</li>
    <li class="nav-item">
      <a class="nav-link <?= $page != 'messages' ? 'collapsed' : '' ?>" href="<?= base_url.'user/?page=messages' ?>">
        <i class="bi bi-chat-dots"></i><span>Messages</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= $page != 'notifications' ? 'collapsed' : '' ?>" href="<?= base_url.'user/?page=notifications' ?>">
        <i class="bi bi-bell"></i><span>Notifications</span>
      </a>
    </li>

    <li class="nav-heading">Settings</li>
    <li class="nav-item">
      <a class="nav-link <?= $page != 'profile' ? 'collapsed' : '' ?>" href="<?= base_url.'user/?page=profile' ?>">
        <i class="bi bi-person"></i><span>Profile</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= $page != 'change_password' ? 'collapsed' : '' ?>" href="<?= base_url.'user/?page=change_password' ?>">
        <i class="bi bi-key"></i><span>Change Password</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= $page != 'faqs' ? 'collapsed' : '' ?>" href="<?= base_url.'user/?page=faqs' ?>">
        <i class="bi bi-question-circle"></i><span>FAQs</span>
      </a>
    </li>
  </ul>
</aside>
