import { extend } from 'flarum/extend';
import app from 'flarum/app';
import IndexPage from 'flarum/components/IndexPage';

app.initializers.add('phpcmf-helloworld', function() {
  extend(IndexPage.prototype, 'sidebarItems', function(items) {
    const message = app.forum.attribute('helloworld.content');
    const title = app.forum.attribute('helloworld.title');

    if (message) {
      items.add('helloworld',
        <div className="Sidebar-item">
          <h3 className="Sidebar-header">{title || 'Hello World'}</h3>
          <div className="helpText">{message}</div>
        </div>
      );
    }
  });
});
