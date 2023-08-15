<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" :href="isActive('/') ? 'javascript:void(0)' : '/'">VidaDemo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" :class="{ active: isActive('/login') }" aria-current="page" :href="isActive('/login') ? 'javascript:void(0)' : '/login'">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" :class="{ active: isActive('/register') }" aria-current="page" :href="isActive('/register') ? 'javascript:void(0)' : '/register'">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>



<script>
export default {
  name: 'AppNavbar',
  methods: {
    isActive(route) {
      return this.$route.path === route
    }
  }

}
</script>