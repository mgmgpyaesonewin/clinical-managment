<template>
  <header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">
          <b>
            <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
            <img src="../assets/images/logo-icon.png" alt="homepage" class="light-logo" />
          </b>
          <span class="hidden-xs">
            <span class="font-bold">BRS</span>Clinical System
          </span>
        </a>
      </div>
      <div class="navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a
              class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark"
              href="javascript:void(0)"
            >
              <i class="ti-menu"></i>
            </a>
          </li>
        </ul>

        <ul class="navbar-nav my-lg-0">
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle waves-effect waves-dark"
              href
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="ti-email"></i>
              <div class="notify">
                <span class="heartbit"></span>
                <span class="point"></span>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
              <ul>
                <li>
                  <div class="drop-title">Notifications</div>
                </li>
                <li>
                  <div class="message-center">
                    <!-- Message -->
                    <a href="javascript:void(0)">
                      <div class="btn btn-danger btn-circle">
                        <i class="fa fa-link"></i>
                      </div>
                      <div class="mail-contnet">
                        <h5>Luanch Admin</h5>
                        <span class="mail-desc">Just see the my new admin!</span>
                        <span class="time">9:30 AM</span>
                      </div>
                    </a>
                    <!-- Message -->
                    <a href="javascript:void(0)">
                      <div class="btn btn-success btn-circle">
                        <i class="ti-calendar"></i>
                      </div>
                      <div class="mail-contnet">
                        <h5>Event today</h5>
                        <span class="mail-desc">Just a reminder that you have event</span>
                        <span class="time">9:10 AM</span>
                      </div>
                    </a>
                    <!-- Message -->
                    <a href="javascript:void(0)">
                      <div class="btn btn-info btn-circle">
                        <i class="ti-settings"></i>
                      </div>
                      <div class="mail-contnet">
                        <h5>Settings</h5>
                        <span class="mail-desc">You can customize this template as you want</span>
                        <span class="time">9:08 AM</span>
                      </div>
                    </a>
                    <!-- Message -->
                    <a href="javascript:void(0)">
                      <div class="btn btn-primary btn-circle">
                        <i class="ti-user"></i>
                      </div>
                      <div class="mail-contnet">
                        <h5>Pavan kumar</h5>
                        <span class="mail-desc">Just see the my admin!</span>
                        <span class="time">9:02 AM</span>
                      </div>
                    </a>
                  </div>
                </li>
                <li>
                  <a class="nav-link text-center link" href="javascript:void(0);">
                    <strong>Check all notifications</strong>
                    <i class="fa fa-angle-right"></i>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <!-- ============================================================== -->
          <!-- End Comment -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Messages -->
          <!-- ============================================================== -->
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle waves-effect waves-dark"
              href
              id="2"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="icon-note"></i>
              <div class="notify">
                <span class="heartbit"></span>
                <span class="point"></span>
              </div>
            </a>
            <div
              class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown"
              aria-labelledby="2"
            >
              <ul>
                <li>
                  <div class="drop-title">You have 4 new messages</div>
                </li>
                <li>
                  <div class="message-center">
                    <!-- Message -->
                    <a href="javascript:void(0)">
                      <div class="user-img">
                        <img src="../assets/images/users/1.jpg" alt="user" class="img-circle" />
                        <span class="profile-status online pull-right"></span>
                      </div>
                      <div class="mail-contnet">
                        <h5>Pavan kumar</h5>
                        <span class="mail-desc">Just see the my admin!</span>
                        <span class="time">9:30 AM</span>
                      </div>
                    </a>
                    <!-- Message -->
                    <a href="javascript:void(0)">
                      <div class="user-img">
                        <img src="/images/users/2.jpg" alt="user" class="img-circle" />
                        <span class="profile-status busy pull-right"></span>
                      </div>
                      <div class="mail-contnet">
                        <h5>Sonu Nigam</h5>
                        <span class="mail-desc">I've sung a song! See you at</span>
                        <span class="time">9:10 AM</span>
                      </div>
                    </a>
                    <!-- Message -->
                    <a href="javascript:void(0)">
                      <div class="user-img">
                        <img src="/images/users/3.jpg" alt="user" class="img-circle" />
                        <span class="profile-status away pull-right"></span>
                      </div>
                      <div class="mail-contnet">
                        <h5>Arijit Sinh</h5>
                        <span class="mail-desc">I am a singer!</span>
                        <span class="time">9:08 AM</span>
                      </div>
                    </a>
                    <!-- Message -->
                    <a href="javascript:void(0)">
                      <div class="user-img">
                        <img src="../assets/images/users/4.jpg" alt="user" class="img-circle" />
                        <span class="profile-status offline pull-right"></span>
                      </div>
                      <div class="mail-contnet">
                        <h5>Pavan kumar</h5>
                        <span class="mail-desc">Just see the my admin!</span>
                        <span class="time">9:02 AM</span>
                      </div>
                    </a>
                  </div>
                </li>
                <li>
                  <a class="nav-link text-center link" href="javascript:void(0);">
                    <strong>See all e-Mails</strong>
                    <i class="fa fa-angle-right"></i>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item dropdown u-pro">
            <a
              class="nav-link dropdown-toggle waves-effect waves-dark profile-pic"
              @click="toggleDropdown"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <img src="../assets/images/users/1.jpg" alt="user" />
              <span class="hidden-md-down">
                {{ user.name }} &nbsp;
                <i class="fa fa-angle-down"></i>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right animated flipInY">
              <a href="javascript:void(0)" class="dropdown-item">
                <i class="ti-user"></i> My Profile
              </a>
              <a href="javascript:void(0)" class="dropdown-item">
                <i class="ti-wallet"></i> My Balance
              </a>
              <a href="javascript:void(0)" class="dropdown-item">
                <i class="ti-email"></i> Inbox
              </a>
              <div class="dropdown-divider"></div>
              <a href="javascript:void(0)" class="dropdown-item">
                <i class="ti-settings"></i> Account Setting
              </a>
              <div class="dropdown-divider"></div>
              <a @click="$store.dispatch('logoutUser')" class="dropdown-item">
                <i class="fa fa-power-off"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  data() {
    return {
      user: this.$store.state.user.data
    };
  },
  methods: {
    toggleDropdown() {
      $(".nav-item.dropdown.u-pro").toggleClass("show");
      $(".dropdown-menu.dropdown-menu-right.animated.flipInY").toggleClass(
        "show"
      );
    }
  }
};
</script>
