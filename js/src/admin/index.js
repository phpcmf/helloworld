import { extend } from 'flarum/extend';
import AdminNav from 'flarum/admin/components/AdminNav';
import AdminLinkButton from 'flarum/admin/components/AdminLinkButton';
import HelloWorldSettingsPage from './components/HelloWorldSettingsPage';

app.initializers.add('phpcmf-hello-world', () => {
  app.routes['helloWorldSettings'] = {path: '/hello-world', component: HelloWorldSettingsPage.component()};
  
  app.extensionData
    .for('phpcmf-hello-world')
    .registerPage(HelloWorldSettingsPage);
  
  extend(AdminNav.prototype, 'items', items => {
    items.add('hello-world', AdminLinkButton.component({
      href: app.route('helloWorldSettings'),
      icon: 'fas fa-comments',
      children: app.translator.trans('phpcmf-hello-world.admin.nav.title'),
      description: app.translator.trans('phpcmf-hello-world.admin.nav.description')
    }));
  });
});    