<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";

defineProps({
  title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
  Inertia.put(
    route("current-team.update"),
    {
      team_id: team.id,
    },
    {
      preserveState: false,
    }
  );
};

const logout = () => {
  Inertia.post(route("logout"));
};
</script>

<template>
  <div>
    <Head :title="title" />

    <JetBanner />

    <div class="min-h-screen bg-gray-100">
      <nav class="relative z-10 bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <!-- Logo -->
              <div class="flex items-center shrink-0">
                <Link :href="route('home')">
                  <JetApplicationMark
                    class="block w-auto h-9 text-emerald-600"
                  />
                </Link>
              </div>

              <!-- Navigation Links -->
              <div
                class="hidden space-x-5 md:space-x-8 sm:-my-px sm:ml-10 sm:flex"
              >
                <JetNavLink
                  :href="route('home')"
                  :active="route().current('home')"
                >
                  Home
                </JetNavLink>
              </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
              <!-- Settings Dropdown -->
              <div class="relative ml-3" v-if="$page.props.user">
                <JetDropdown align="right" width="48">
                  <template #trigger>
                    <button
                      v-if="$page.props.jetstream.managesProfilePhotos"
                      class="
                        flex
                        text-sm
                        rounded-full
                        border-2 border-transparent
                        transition
                        focus:outline-none focus:border-gray-300
                      "
                    >
                      <img
                        class="object-cover w-8 h-8 rounded-full"
                        :src="$page.props.user.profile_photo_url"
                        :alt="$page.props.user.name"
                      />
                    </button>

                    <span v-else class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="
                          inline-flex
                          items-center
                          px-3
                          py-2
                          text-sm
                          font-medium
                          leading-4
                          text-gray-500
                          bg-white
                          rounded-md
                          border border-transparent
                          transition
                          hover:text-gray-700
                          focus:outline-none
                        "
                      >
                        {{ $page.props.user.name }}

                        <svg
                          class="-mr-0.5 ml-2 w-4 h-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                      Manage Account
                    </div>

                    <JetDropdownLink :href="route('profile.show')">
                      Profile
                    </JetDropdownLink>

                    <JetDropdownLink
                      v-if="$page.props.jetstream.hasApiFeatures"
                      :href="route('api-tokens.index')"
                    >
                      API Tokens
                    </JetDropdownLink>

                    <div class="border-t border-gray-100" />

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                      <JetDropdownLink as="button"> Log Out </JetDropdownLink>
                    </form>
                  </template>
                </JetDropdown>
              </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
              <button
                class="
                  inline-flex
                  justify-center
                  items-center
                  p-2
                  text-gray-400
                  rounded-md
                  transition
                  hover:text-gray-500 hover:bg-gray-100
                  focus:outline-none focus:bg-gray-100 focus:text-gray-500
                "
                @click="showingNavigationDropdown = !showingNavigationDropdown"
              >
                <svg
                  class="w-6 h-6"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    :class="{
                      hidden: showingNavigationDropdown,
                      'inline-flex': !showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{
                      hidden: !showingNavigationDropdown,
                      'inline-flex': showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>

            <div
              class="hidden items-center space-x-2 text-gray-500 sm:flex"
              v-if="!$page.props.user"
            >
              <Link
                :href="route('login')"
                class="
                  block
                  px-4
                  py-3
                  text-base
                  font-medium
                  text-center text-emerald-800
                  bg-emerald-100
                  rounded-lg
                  hover:bg-emerald-200
                  focus:outline-none
                  focus:ring-2
                  focus:ring-offset-2
                  focus:ring-emerald-300
                "
              >
                Log In
              </Link>
              <Link
                :href="route('register')"
                class="
                  block
                  px-4
                  py-3
                  text-base
                  font-medium
                  text-center text-white
                  bg-emerald-700
                  rounded-lg
                  hover:bg-emerald-600
                  focus:outline-none
                  focus:ring-2
                  focus:ring-offset-2
                  focus:ring-emerald-500
                "
              >
                Join Now
              </Link>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
          :class="{
            block: showingNavigationDropdown,
            hidden: !showingNavigationDropdown,
          }"
          class="sm:hidden"
        >
          <div class="pt-2 pb-3 space-y-1">
            <JetResponsiveNavLink
              :href="route('home')"
              :active="route().current('home')"
            >
              Home
            </JetResponsiveNavLink>

            <JetResponsiveNavLink
              :href="route('home')"
              :active="route().current('posts')"
            >
              Posts
            </JetResponsiveNavLink>

            <JetResponsiveNavLink
              :href="route('home')"
              :active="route().current('categories')"
            >
              Categories
            </JetResponsiveNavLink>

            <JetResponsiveNavLink
              :href="route('login')"
              :active="route().current('login')"
            >
              Log In
            </JetResponsiveNavLink>
            <JetResponsiveNavLink
              :href="route('register')"
              :active="route().current('register')"
            >
              Join Now
            </JetResponsiveNavLink>
          </div>

          <!-- Responsive Settings Options -->
          <div
            class="pt-4 pb-1 border-t border-gray-200"
            v-if="$page.props.user"
          >
            <div class="flex items-center px-4">
              <div
                v-if="$page.props.jetstream.managesProfilePhotos"
                class="mr-3 shrink-0"
              >
                <img
                  class="object-cover w-10 h-10 rounded-full"
                  :src="$page.props.user.profile_photo_url"
                  :alt="$page.props.user.name"
                />
              </div>

              <div>
                <div class="text-base font-medium text-gray-800">
                  {{ $page.props.user.name }}
                </div>
                <div class="text-sm font-medium text-gray-500">
                  {{ $page.props.user.email }}
                </div>
              </div>
            </div>

            <div class="mt-3 space-y-1">
              <JetResponsiveNavLink
                :href="route('profile.show')"
                :active="route().current('profile.show')"
              >
                Profile
              </JetResponsiveNavLink>

              <JetResponsiveNavLink
                v-if="$page.props.jetstream.hasApiFeatures"
                :href="route('api-tokens.index')"
                :active="route().current('api-tokens.index')"
              >
                API Tokens
              </JetResponsiveNavLink>

              <!-- Authentication -->
              <form method="POST" @submit.prevent="logout">
                <JetResponsiveNavLink as="button">
                  Log Out
                </JetResponsiveNavLink>
              </form>

              <!-- Team Management -->
              <template v-if="$page.props.jetstream.hasTeamFeatures">
                <div class="border-t border-gray-200" />

                <div class="block px-4 py-2 text-xs text-gray-400">
                  Manage Team
                </div>

                <!-- Team Settings -->
                <JetResponsiveNavLink
                  :href="route('teams.show', $page.props.user.current_team)"
                  :active="route().current('teams.show')"
                >
                  Team Settings
                </JetResponsiveNavLink>

                <JetResponsiveNavLink
                  v-if="$page.props.jetstream.canCreateTeams"
                  :href="route('teams.create')"
                  :active="route().current('teams.create')"
                >
                  Create New Team
                </JetResponsiveNavLink>

                <div class="border-t border-gray-200" />

                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                  Switch Teams
                </div>

                <template
                  v-for="team in $page.props.user.all_teams"
                  :key="team.id"
                >
                  <form @submit.prevent="switchToTeam(team)">
                    <JetResponsiveNavLink as="button">
                      <div class="flex items-center">
                        <svg
                          v-if="team.id == $page.props.user.current_team_id"
                          class="mr-2 w-5 h-5 text-green-400"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                          />
                        </svg>
                        <div>{{ team.name }}</div>
                      </div>
                    </JetResponsiveNavLink>
                  </form>
                </template>
              </template>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header v-if="$slots.header" class="bg-white shadow">
        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
