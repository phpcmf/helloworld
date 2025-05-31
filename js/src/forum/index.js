import { extend } from 'flarum/extend';
import app from 'flarum/app';
import HelloWorldPage from './components/HelloWorldPage';

app.initializers.add('phpcmf-hello-world', () => {
  app.routes['helloWorld'] = {path: '/hello-world', component: HelloWorldPage.component()};
  
  app.extensionData
    .for('phpcmf-hello-world')
    .registerPage(HelloWorldPage);
});    