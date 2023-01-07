<h1 align="center">
  Ember Gardens: Wordpress Back-end
</h1>

Ember Gardens is a website built on the React & GatsbyJS Framework, using Wordpress as a headless CMS which provides a GraphQL data layer.

## 🧱 Structure & Hosting

Since Wordpress is being used in a headless way, it means the backend is completely decoupled from the front-end experience.
That means each has their own repo, hosting and domain.

### Front-end (React / Gatsby)
- **Repo**: [ember-gardens-com](https://github.com/embergardens/ember-gardens-com)
- **Hosting**: [Gatsby Cloud](https://www.gatsbyjs.com/dashboard/organization/3346176b-e663-4361-bb7a-cb6a2aa9bd64/sites)
- **Domain**: [https://embergardens.com](https://embergardens.com) - managed by [1 & 1](https://www.ionos.com/) & SSL provided by Gatsby Cloud

### Back-end (Wordpress)
- **Repo**: [EmberHarvest: Custom Headless Wordpress Theme](https://github.com/embergardens/emberharvest)
- **Hosting**: [Flywheel](https://app.getflywheel.com/sites#)
- **Domain**: Both domains are managed by [1 & 1](https://www.ionos.com/) & SSLs are provided by Flywheel
  - **Primay**: [Ember Gardens WP Production Admin](https://admin.embergardens.com/wp-admin/)
  - **Staging**: [Ember Gardens WP Staging Admin](https://admin-embergardens.flywheelstaging.com/wp-admin/)

## 🔧 Development Notes

Since the Wordpress instance is hosted by Flywheel, the easiest way to make updates is to use Flywheel's [Local]() app. This allows you to sync directly with production and staging and pull/push from a local enviornment. Updates should never be made directly in Staging or Production to anything other than content/settings/media, as those changes won't be saved in the repo.

_**NOTE:** Plugins should **NEVER** be updated by anyone other than an expiereneced developer, and only after carefully reading Changelogs and testing Locally and on Staging._

## 🔌 Important Plugins
- **Advanced Custom Fields Pro**: Custom field creation & management. Original license owned by Tim Spears. Update fields locally and push the new theme to Staging/Production. ACF stores changes in **`/acf-json`** which can then by sync'd up with the new enviornment. [Learn More](https://www.advancedcustomfields.com/resources/local-json/)

- **Gravity Forms**: This is the form management plugin which can integrate with Ember Gardens MailChimp account.

- **WP Gatsby**, **WP GraphQL**: Required plugins to integrate Wordpress & Gatsby JS.

- **WP GraphQL for Advanced Custom Fields**, **WP GraphQL for Gravity Forms**: Most Wordpress plugins require an additional plugin in order to convert that plugin's data into a GraphQL format so that it can be exposed and accessed by Gatsby.

