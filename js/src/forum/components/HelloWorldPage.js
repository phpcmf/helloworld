import Component from 'flarum/common/Component';
import Button from 'flarum/common/components/Button';
import TextField from 'flarum/common/components/TextField';
import ItemList from 'flarum/common/utils/ItemList';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';

export default class HelloWorldPage extends Component {
  init() {
    this.message = '';
    this.loading = false;
    this.helloWorlds = [];
    this.error = null;
    
    this.loadHelloWorlds();
  }
  
  loadHelloWorlds() {
    this.loading = true;
    this.error = null;
    
    app.store.find('hello-world')
      .then(helloWorlds => {
        this.helloWorlds = helloWorlds;
        this.loading = false;
        m.redraw();
      })
      .catch(error => {
        this.error = error;
        this.loading = false;
        m.redraw();
      });
  }
  
  submit() {
    if (!this.message) return;
    
    this.loading = true;
    this.error = null;
    
    app.store.createRecord('hello-world')
      .save({
        message: this.message
      })
      .then(() => {
        this.message = '';
        this.loadHelloWorlds();
      })
      .catch(error => {
        this.error = error;
        this.loading = false;
        m.redraw();
      });
  }
  
  view() {
    return (
      <div className="HelloWorldPage container">
        <h2 className="HelloWorldPage-title">Hello World</h2>
        
        <div className="HelloWorldPage-form">
          <TextField
            className="FormControl"
            placeholder="输入消息..."
            value={this.message}
            oninput={e => this.message = e.target.value}
          />
          
          <Button
            className="Button Button--primary"
            disabled={this.loading || !this.message}
            onclick={this.submit.bind(this)}
          >
            {this.loading ? <LoadingIndicator /> : '发送'}
          </Button>
          
          {this.error && 
            <div className="error-message">
              {this.error.message}
            </div>
          }
        </div>
        
        <div className="HelloWorldPage-messages">
          {this.loading ? 
            <LoadingIndicator /> : 
            this.helloWorlds.map(hello => (
              <div className="HelloWorldPage-message">
                <p>{hello.message}</p>
                <small>
                  {app.translator.trans('core.forum.index.posted_by_text', {
                    user: <a href={app.route('user', {username: hello.user.username})}>{hello.user.username}</a>,
                    time: <span>{app.formatter.datetime(hello.createdAt)}</span>
                  })}
                </small>
              </div>
            ))
          }
        </div>
      </div>
    );
  }
}    