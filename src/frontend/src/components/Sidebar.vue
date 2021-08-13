<template>
  <div class>
    <aside class="left-sidebar">
      <div class="scroll-sidebar">
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="user-pro">
              <a
                class="has-arrow waves-effect waves-dark"
                href="javascript:void(0)"
                aria-expanded="false"
              >
                <img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle" />
                <span class="hide-menu">{{user.name}}</span>
              </a>
              <ul aria-expanded="false" class="collapse">
                <li>
                  <a href="javascript:void(0)">
                    <i class="ti-user"></i> My Profile
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="ti-wallet"></i> My Balance
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="ti-email"></i> Inbox
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="ti-settings"></i> Account Setting
                  </a>
                </li>
                <li>
                  <a @click="$store.dispatch('logoutUser')">
                    <i class="fa fa-power-off"></i> Logout
                  </a>
                </li>
              </ul>
            </li>
            <router-link tag="li" to="/users">
              <a class="waves-effect waves-dark">
                <i class="fa fa-user-md"></i>
                <span class="hide-menu">Users</span>
              </a>
            </router-link>
            <!-- <router-link tag="li" to="/patients">
              <a class="waves-effect waves-dark">
                <i class="fa fa-user"></i>
                <span class="hide-menu">Patients</span>
              </a>
            </router-link> -->
            <router-link tag="li" to="/consultations">
              <a class="waves-effect waves-dark">
                <i class="fa fa-user-md"></i>
                <span class="hide-menu">Consultations</span>
              </a>
            </router-link>
            <router-link tag="li" to="/roles">
              <a class="waves-effect waves-dark">
                <i class="fa fa-user"></i>
                <span class="hide-menu">Roles</span>
              </a>
            </router-link>
            <router-link tag="li" to="/investresult">
              <a class="waves-effect waves-dark">
                <i class="ti-comments"></i>
                <span class="hide-menu">Request Cases</span>
              </a>
            </router-link>
            <router-link tag="li" to="/doctor/session">
              <a class="waves-effect waves-dark">
                <i class="ti-alarm-clock"></i>
                <span class="hide-menu">Sessions</span>
              </a>
            </router-link>
             <router-link tag="li" to="/patients/report">
              <a class="waves-effect waves-dark">
                <i class="ti-alarm-clock"></i>
                <span class="hide-menu">Report</span>
              </a>
            </router-link>
            <router-link tag="li" to="/appointments">
              <a class="waves-effect waves-dark">
                <i class="ti-alarm-clock"></i>
                <span class="hide-menu">Appointment</span>
              </a>
            </router-link>
            <router-link tag="li" to="/products">
              <a class="waves-effect waves-dark">
                <i class="ti-layout-list-thumb"></i>
                <span class="hide-menu">Products</span>
              </a>
            </router-link>
            <router-link tag="li" to="/checkout">
              <a class="waves-effect waves-dark">
                <i class="ti-credit-card"></i>
                <span class="hide-menu">Phermacy</span>
              </a>
            </router-link>
            <router-link tag="li" to="/service">
              <a class="waves-effect waves-dark">
                <i class="ti-settings"></i>
                <span class="hide-menu">Services</span>
              </a>
            </router-link>
            <router-link tag="li" to="/addservice">
              <a class="waves-effect waves-dark">
                <i class="ti-plus"></i>
                <span class="hide-menu">Add Services</span>
              </a>
            </router-link>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: this.$store.state.user.data
    };
  }
};
</script>
