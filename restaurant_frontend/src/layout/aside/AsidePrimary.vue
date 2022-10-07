<template>
  <div
      class="aside-primary d-flex flex-column align-items-lg-center flex-row-auto"
  >
    <div
        class="
        aside-logo
        d-none d-lg-flex
        flex-column
        align-items-center
        flex-column-auto
        py-10
      "
        id="kt_aside_logo"
    >
      <a href="/">
        <img alt="Logo" src="media/logos/logo-demo7.svg" class="h-30px" />
      </a>
    </div>

    <div
        class="
        aside-nav
        d-flex
        flex-column
        align-items-center
        flex-column-fluid
        w-100
        pt-5 pt-lg-0
      "
        style="height: 10px;"
        id="kt_aside_nav"
    >
      <div
          class="hover-scroll-y mb-10"
          data-kt-scroll="true"
          data-kt-scroll-activate="{default: false, lg: true}"
          data-kt-scroll-height="auto"
          data-kt-scroll-wrappers="#kt_aside_nav"
          data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
          data-kt-scroll-offset="0px"
      >
        <ul class="nav flex-column">
          <li
              class="nav-item mb-2"
              data-bs-toggle="tooltip"
              data-bs-trigger="hover"
              data-bs-placement="right"
              data-bs-dismiss="click"
              title="Users"
              data-bs-original-title="Users"
              v-if="(role == 1)"
          >
            <router-link
                class="nav-link text-active-primary me-6"
                to="users"
            >
              <span class="svg-icon svg-icon-2x">
                <inline-svg src="media/icons/duotune/general/gen049.svg" />
              </span>
            </router-link>
          </li>

          <li
              class="nav-item mb-2"
              data-bs-toggle="tooltip"
              data-bs-trigger="hover"
              data-bs-placement="right"
              data-bs-dismiss="click"
              title="Menus"
              data-bs-original-title="Menus"
              v-if="(role == 1)||(role == 2)"
          >
            <router-link
                class="nav-link text-active-primary me-6"
                to="menus"
                active-class="unActive"
            >
              <span class="svg-icon svg-icon-2x">
                <inline-svg src="media/icons/duotune/general/gen028.svg" />
              </span>
            </router-link>
          </li>

          <li
              class="nav-item mb-2"
              data-bs-toggle="tooltip"
              data-bs-trigger="hover"
              data-bs-placement="right"
              data-bs-dismiss="click"
              title="Categories"
              data-bs-original-title="Categories"
              v-if="(role == 1)||(role == 2)"
          >
            <router-link
                class="nav-link text-active-primary me-6"
                to="categories"
                active-class="unActive"
            >
              <span class="svg-icon svg-icon-2x">
                <inline-svg src="media/icons/duotune/general/gen008.svg" />
              </span>
            </router-link>
          </li>

          <li
              class="nav-item mb-2"
              data-bs-toggle="tooltip"
              data-bs-trigger="hover"
              data-bs-placement="right"
              data-bs-dismiss="click"
              title="Items"
              data-bs-original-title="Items"
              v-if="(role == 1)||(role == 2)"
          >
            <router-link
                class="nav-link text-active-primary me-6"
                to="#"
                active-class="unActive"
            >
              <span class="svg-icon svg-icon-2x">
                <inline-svg src="media/icons/duotune/general/gen005.svg" />
              </span>
            </router-link>
          </li>
        </ul>
      </div>
    </div>

    <div
        class="
        aside-footer
        d-flex
        flex-column
        align-items-center
        flex-column-auto
      "
        style="height: 40px;"
        id="kt_aside_footer"
    >
      <a @click="signOut()" class="text-danger">
        <span class="svg-icon svg-icon-2x">
                <inline-svg src="media/icons/duotune/arrows/arr043.svg" />
              </span>
      </a>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import {useStore} from "vuex";
import {useRouter} from "vue-router";
import {Actions} from "@/store/enums/StoreEnums";
export default defineComponent({
  name: "kt-aside-primary",
  components: {
  },
  data() {
    return {
      role: 0,
    }
  },
  mounted() {
    const store = useStore();
    if(store.getters.userRole == 'admin') {
      this.role = 1;
    }
    if(store.getters.userRole == 'restaurant admin') {
      this.role = 2;
    }
  },
  setup() {
    const router = useRouter();
    const store = useStore();
    const signOut = () => {
      store
          .dispatch(Actions.LOGOUT)
          .then(() => router.push({ name: "sign-in" }));
    };
    return {
      signOut,
    };
  },
});
</script>
