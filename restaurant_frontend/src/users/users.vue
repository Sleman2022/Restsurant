<template>
  <div class="card">
    <div class="card-header border-0 pt-6">
      <div class="card-toolbar">
      </div>
      <!--end::Card toolbar-->
    </div>
    <div class="card-body pt-0">
      <!--begin::Users-->
      <div class="mb-15">
        <!--begin::List-->
        <div class="mh-375px scroll-y me-n7 pe-7">
          <template v-for="(user, index) in my_users.data" :key="index">
            <!--begin::User-->
            <div
                class="
                    d-flex
                    flex-stack
                    py-5
                    border-bottom border-gray-300 border-bottom-dashed
                  "
            >
              <!--begin::Details-->
              <div class="d-flex align-items-center">
<!--                &lt;!&ndash;begin::Avatar&ndash;&gt;-->
<!--                <div class="symbol symbol-35px symbol-circle">-->
<!--                  <img v-if="user.avatar" alt="Pic" :src="user.avatar" />-->
<!--                        {{ user.name}}-->
<!--                </div>-->
<!--                &lt;!&ndash;end::Avatar&ndash;&gt;-->

                <!--begin::Details-->
                <div class="ms-6">
                  <!--begin::Name-->
                  <a
                      href="#"
                      class="
                          d-flex
                          align-items-center
                          fs-5
                          fw-bolder
                          text-dark text-hover-primary
                        "
                  >
                    {{ user.name }}

                    <span v-if="user.role == 'user'" class="badge badge-light-danger fs-8 fw-bold ms-2">
                          {{ user.role }}
                    </span>
                    <span v-if="user.role == 'admin'" class="badge badge-light-success fs-8 fw-bold ms-2">
                          {{ user.role }}
                    </span>
                  </a>
                  <!--end::Name-->

                  <!--begin::Email-->
                  <div class="fw-bold text-gray-400">{{ user.email }}</div>
                  <!--end::Email-->
                </div>
                <!--end::Details-->
              </div>
              <!--end::Details-->

              <!--begin::Stats-->
              <div class="d-flex">
                <!--begin::Row-->
                <div class="row fv-row">
                  <!--begin::Col-->
                    <Field
                        v-model="user.role"
                        name="userRole"
                        class="form-select form-select-solid"
                        data-control="select2"
                        data-hide-search="true"
                        data-placeholder="Role"
                        as="select"
                        @change="changeRole(user.role,user.id)"
                    >
                      <option value="admin">admin</option>
                      <option value="user">user</option>
                    </Field>
                </div>
              </div>
              <!--end::Stats-->
            </div>
            <!--end::User-->
          </template>
        </div>
        <!--end::List-->
      </div>
      <!--end::Users-->
    </div>
  </div>
  <el-pagination v-if="my_users.meta"
      v-model:current-page="my_users.meta.current_page"
      @current-change="getUsers"
      :page-size="my_users.meta.per_page"
      layout="prev, pager, next"
      :total="my_users.meta.total"
      :hide-on-single-page="true"
      background
  >
  </el-pagination>
</template>
<script lang="ts">
import { defineComponent } from "vue";
import { Field} from "vee-validate";
import axios from "axios";
export default defineComponent(
{
  name: "customers-listing",
  props: {
    users: {},
    },
  components: {
    Field,
  },
  data: function() {
    return {
      my_users : {},
      page: 1,
    }
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    getUsers(page = 1)
    {
      const self = this;
      axios.defaults.headers.get['header-name'] = 'value';
      axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
      axios.get(process.env.VUE_APP_API_URL + '/users?page=' + page)
          .then(function (response) {
            self.my_users = response.data;
            self.page = page;
          })
          .catch(function (error) {
            console.log(error);
          });
    },
    changeRole(role,id)
    {
      const self = this;
      axios.defaults.headers.get['header-name'] = 'value';
      axios.defaults.headers.get['Access-Control-Allow-Origin'] = '*';
      axios.put(process.env.VUE_APP_API_URL + '/change-role',{role:role,id:id})
          .then(function (response) {
            self.my_users = response.data;
            self.getUsers(self.page);
          })
          .catch(function (error) {
            console.log(error);
          });
    },
  },
});
</script>
