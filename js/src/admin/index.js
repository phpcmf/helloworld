import { extend } from 'flarum/extend';
import AdminNav from 'flarum/components/AdminNav';
import AdminLinkButton from 'flarum/components/AdminLinkButton';
import HelloWorldPage from './HelloWorldPage';

app.initializers.add('phpcmf-helloworld', function() {
  app.routes['helloworld'] = { path: '/helloworld', component: HelloWorldPage.component() };

  app.extensionData
    .for('phpcmf-helloworld')
    .registerSetting({
      label: app.translator.trans('phpcmf-helloworld.admin.settings.title_label'),
      setting: 'phpcmf-helloworld.title',
      type: 'text'
    })
    .registerSetting({
      label: app.translator.trans('phpcmf-helloworld.admin.settings.content_label'),
      setting: 'phpcmf-helloworld.content',
      type: 'textarea'
    });

  extend(AdminNav.prototype, 'items', function(items) {
    items.add('helloworld', AdminLinkButton.component({
      href: app.route('helloworld'),
      icon: 'fas fa-comments',
      children: app.translator.trans('phpcmf-helloworld.admin.nav.title'),
      description: app.translator.trans('phpcmf-helloworld.admin.nav.description')
    }));
  });
});
