const Artikel = {
  template: `
    <div>

        <h2>Manajemen Data Artikel</h2>

        <button id="btn-tambah" @click="tambah">
            Tambah Data
        </button>

        <!-- Modal -->
        <div class="modal" v-if="showForm">

            <div class="modal-content">

                <span class="close" @click="showForm = false">
                    &times;
                </span>

                <form id="form-data" @submit.prevent="saveData">

                    <h3>{{ formTitle }}</h3>

                    <div>
                        <input
                            type="text"
                            v-model="formData.judul"
                            placeholder="Judul Artikel"
                            required
                        >
                    </div>

                    <div>
                        <textarea
                            v-model="formData.isi"
                            rows="6"
                            placeholder="Isi Artikel"
                            required>
                        </textarea>
                    </div>

                    <div>
                        <select v-model="formData.status">

                            <option
                                v-for="option in statusOptions"
                                :value="option.value">

                                {{ option.text }}

                            </option>

                        </select>
                    </div>

                    <input
                        type="hidden"
                        v-model="formData.id"
                    >

                    <button type="submit" id="btnSimpan">
                        Simpan
                    </button>

                    <button
                        type="button"
                        @click="showForm = false">

                        Batal

                    </button>

                </form>

            </div>

        </div>

        <!-- Table -->
        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                <tr
                    v-for="(row, index) in artikel"
                    :key="row.id">

                    <td class="center-text">
                        {{ row.id }}
                    </td>

                    <td>
                        {{ row.judul }}
                    </td>

                    <td>
                        {{ statusText(row.status) }}
                    </td>

                    <td class="center-text">

                        <a
                            href="#"
                            @click.prevent="edit(row)">

                            Edit

                        </a>

                        |

                        <a
                            href="#"
                            @click.prevent="hapus(index, row.id)">

                            Hapus

                        </a>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>
    `,

  data() {
    return {
      artikel: [],
      formData: {
        id: null,
        judul: "",
        isi: "",
        status: 0,
      },
      showForm: false,
      formTitle: "Tambah Data",
      statusOptions: [
        {
          text: "Draft",
          value: 0,
        },
        {
          text: "Publish",
          value: 1,
        },
      ],
    };
  },

  mounted() {
    this.loadData();
  },

  methods: {
    loadData() {
      axios
        .get(apiUrl + "/post")
        .then((response) => {
          if (response.data.data) {
            this.artikel = response.data.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    tambah() {
      this.formTitle = "Tambah Data";

      this.formData = {
        id: null,
        judul: "",
        isi: "",
        status: 0,
      };

      this.showForm = true;
    },

    edit(data) {
      this.formTitle = "Ubah Data";

      this.formData = {
        id: data.id,
        judul: data.judul,
        isi: data.isi,
        status: data.status,
      };

      this.showForm = true;
    },

    saveData() {
      if (this.formData.id) {
        // UPDATE
        const form = new FormData();
        form.append("judul", this.formData.judul);
        form.append("isi", this.formData.isi);
        form.append("status", this.formData.status);
        form.append("_method", "PUT"); // ← ini kuncinya!

        axios
          .post(apiUrl + "/post/" + this.formData.id, form)
          .then(() => {
            this.loadData();
            this.showForm = false;
            alert("Data berhasil diupdate");
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        // CREATE — biarkan seperti semula
        const form = new FormData();
        form.append("judul", this.formData.judul);
        form.append("isi", this.formData.isi);

        axios
          .post(apiUrl + "/post", form)
          .then(() => {
            this.loadData();
            this.showForm = false;
            alert("Data berhasil ditambahkan");
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },

    hapus(index, id) {
      if (!confirm("Yakin menghapus data?")) {
        return;
      }

      axios
        .delete(apiUrl + "/post/" + id)

        .then(() => {
          this.artikel.splice(index, 1);

          alert("Data berhasil dihapus");
        })

        .catch((error) => {
          console.log(error);
        });
    },

    statusText(status) {
      return status == 1 ? "Publish" : "Draft";
    },
  },
};