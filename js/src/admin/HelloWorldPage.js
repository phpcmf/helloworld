import Component from 'flarum/Component';
import Button from 'flarum/components/Button';
import TextField from 'flarum/components/TextField';
import TextAreaField from 'flarum/components/TextAreaField';
import LoadingIndicator from 'flarum/components/LoadingIndicator';

export default class HelloWorldPage extends Component {
  init() {
    this.title = m.prop(app.settings['phpcmf-helloworld.title'] || '');
    this.content = m.prop(app.settings['phpcmf-helloworld.content'] || '');
    this.saving = m.prop(false);
  }

  view() {
    return (
      <div className="SettingsPage">
        <div className="container">
          <div className="row">
            <div className="SettingsPage-nav col-md-3">
              <div className="SideNav">
                <ul>
                  <li className="active">
                    <a href="#">{app.translator.trans('phpcmf-helloworld.admin.nav.title')}</a>
                  </li>
                </ul>
              </div>
            </div>
            <div className="SettingsPage-content col-md-9">
              <form onsubmit={this.onsubmit.bind(this)}>
                <h2 className="SettingsPage-title">
                  {app.translator.trans('phpcmf-helloworld.admin.title')}
                </h2>

                <div className="Form-group">
                  <TextField
                    label={app.translator.trans('phpcmf-helloworld.admin.settings.title_label')}
                    value={this.title()}
                    oninput={m.withAttr('value', this.title)}
                  />
                </div>

                <div className="Form-group">
                  <TextAreaField
                    label={app.translator.trans('phpcmf-helloworld.admin.settings.content_label')}
                    value={this.content()}
                    oninput={m.withAttr('value', this.content)}
                  />
                </div>

                <div className="Form-group">
                  <Button
                    type="submit"
                    className="Button Button--primary"
                    loading={this.saving()}
                  >
                    {app.translator.trans('core.admin.settings.save_changes_button')}
                  </Button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    );
  }

  onsubmit(e) {
    e.preventDefault();

    this.saving(true);

    app.request({
      method: 'POST',
      url: app.forum.attribute('apiUrl') + '/helloworld',
      data: {
        data: {
          type: 'helloworld-messages',
          attributes: {
            title: this.title(),
            content: this.content()
          }
        }
      }
    }).then(() => {
      app.settings['phpcmf-helloworld.title'] = this.title();
      app.settings['phpcmf-helloworld.content'] = this.content();
      
      app.alerts.show({
        type: 'success',
        message: app.translator.trans('phpcmf-helloworld.admin.saved_message')
      });
      
      this.saving(false);
    }, (error) => {
      app.alerts.show(error);
      this.saving(false);
    });
  }
}
