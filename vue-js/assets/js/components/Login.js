const Login = {
  template: `
        <div class="login-container">
            <div class="login-box">
                <h2>Form Login Admin</h2>
                <form @submit.prevent="handleLogin">
                    <div class="form-group">
                        <label>Username / Email</label>
                        <input type="text" v-model="username" placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" v-model="password" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn-login">Masuk Aplikasi</button>
                </form>
                <p v-if="errorMessage" class="error-msg">{{ errorMessage }}</p>
            </div>
        </div>
    `,
  data() {
    return {
      username: "",
      password: "",
      errorMessage: "",
    };
  },
  methods: {
    handleLogin() {
      // Mengirim data kredensial ke API Endpoint backend CI4
      axios
        .post(apiUrl + "/api/login", {
          username: this.username,
          password: this.password,
        })
        .then((response) => {
          if (response.data.status === 200) {
            localStorage.setItem("isLoggedIn", "true");
            localStorage.setItem("userToken", response.data.data.token);

            // Update state isLoggedIn di root app supaya navbar langsung berubah
            this.$root.isLoggedIn = true;

            // Pindah ke halaman artikel tanpa reload
            this.$router.push("/artikel");
          }
        })
        .catch((error) => {
          // Tangkap pesan error dari response backend jika gagal login
          if (error.response && error.response.data.messages) {
            this.errorMessage = error.response.data.messages;
          } else {
            this.errorMessage = "Terjadi kesalahan jaringan atau server.";
          }
        });
    },
  },
};
