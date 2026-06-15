const { createApp } = Vue;
const { createRouter, createWebHashHistory } = VueRouter;

// URL API backend CI4 kamu — sesuaikan dengan path project kamu
const apiUrl = "http://localhost:8080";

// Interceptor REQUEST — otomatis sisipkan token di setiap request keluar
axios.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('userToken');

        if (token) {
            config.headers['Authorization'] = 'Bearer ' + token;
        }

        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

// Interceptor RESPONSE — tangkap kalau server balas dengan error 401
axios.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        if (error.response && error.response.status === 401) {
            alert('Sesi kamu sudah berakhir atau token tidak sah. Silakan login kembali.');
            localStorage.clear();
            window.location.href = '#/login';
            window.location.reload();
        }
        return Promise.reject(error);
    }
);


// 1. Daftar Rute — tambah Login dan meta requiresAuth di Artikel & About
const routes = [
  { path: "/", component: Home },
  { path: "/login", component: Login },
  {
    path: "/artikel",
    component: Artikel,
    meta: { requiresAuth: true }, // halaman ini butuh login
  },
  {
    path: "/about",
    component: About,
    meta: { requiresAuth: true }, // halaman ini juga diproteksi
  },
];

// 2. Buat Router
const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

// 3. Navigation Guard — "satpam" yang jaga setiap perpindahan halaman
router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem("isLoggedIn") === "true";

  if (
    to.matched.some((record) => record.meta.requiresAuth) &&
    !isAuthenticated
  ) {
    alert("Akses Ditolak! Kamu harus login terlebih dahulu.");
    next("/login");
  } else {
    next();
  }
});

// 4. Root App — tempat state global seperti status login dan fungsi logout
const app = createApp({
  data() {
    return {
      isLoggedIn: false,
    };
  },
  mounted() {
    // Cek localStorage pas pertama kali app dibuka
    this.isLoggedIn = localStorage.getItem("isLoggedIn") === "true";
  },
  methods: {
    logout() {
      if (confirm("Yakin mau keluar?")) {
        localStorage.removeItem("isLoggedIn");
        localStorage.removeItem("userToken");
        this.isLoggedIn = false;
        this.$router.push("/");
      }
    },
  },
});

app.use(router);
app.mount("#app");
