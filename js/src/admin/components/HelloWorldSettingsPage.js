import Component from 'flarum/common/Component';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';
import SaveButton from 'flarum/common/components/SaveButton';
import SettingsPage from 'flarum/admin/components/SettingsPage';

export default class HelloWorldSettingsPage extends SettingsPage {
  init() {
    super.init();
    
    this.loading = true;
    this.saving = false;
    
    // 加载设置
    this.loadSettings();
  }
  
  loadSettings() {
    // 实际项目中这里应该从API加载设置
    this.loading = false;
    m.redraw();
  }
  
  saveSettings() {
    this.saving = true;
    
    // 实际项目中这里应该保存设置到API
    setTimeout(() => {
      this.saving = false;
      m.redraw();
    }, 1000);
  }
  
  view() {
    return (
      <div className="SettingsPage">
        <div className="container">
          <div className="SettingsPage-nav">
            <div className="Backdrop"></div>
            {this.renderNavItems()}
          </div>
          
          <div className="SettingsPage-content">
            <div className="Header">
              <h1>Hello World 设置</h1>
            </div>
            
            <div className="SettingsPage-body">
              {this.loading ? 
                <LoadingIndicator /> : 
                <form onsubmit={this.onsubmit.bind(this)}>
                  <div className="Form-group">
                    <label>设置项示例</label>
                    <input 
                      type="text" 
                      className="FormControl" 
                      bidi={this.setting('phpcmf-hello-world.example_setting')} 
                    />
                    <p className="helpText">这是一个设置项的示例</p>
                  </div>
                  
                  <div className="Form-group">
                    <SaveButton loading={this.saving} />
                  </div>
                </form>
              }
            </div>
          </div>
        </div>
      </div>
    );
  }
}    