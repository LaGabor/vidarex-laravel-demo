<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Register</h4>
        <form @submit.prevent="register">
          <div class="mb-3">
            <label for="username" class="form-label">Name</label>
            <input v-model="username" type="text" class="form-control" id="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Email</label>
            <input v-model="email" type="email" class="form-control" id="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input v-model="password" type="password" class="form-control" id="password" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password Check</label>
            <input v-model="passwordCheck" type="password" class="form-control" id="password" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: '',
      password: '',
      passwordCheck: '',
      email:'',
    };
  },
  methods: {
    register() {
      console.log('Username:', this.username);
      console.log('Password:', this.password);
      console.log('Password Check:', this.passwordCheck);
      console.log('Email :', this.email);
    },
  },
};
</script>

<style>

</style>