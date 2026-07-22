with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'r', encoding='utf-8') as f:
    content = f.read()

target = "return (\n                <div className=\"min-h-screen flex flex-col bg-slate-50\">"

replacement = """if (currentView === 'login') {
                return <LoginComponent onLoginSuccess={() => setCurrentView('app')} onSkipToApp={() => setCurrentView('app')} />;
            }

            return (
                <div className="min-h-screen flex flex-col bg-slate-50">"""

if target in content:
    content = content.replace(target, replacement)
    with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'w', encoding='utf-8') as f:
        f.write(content)
    print("SUCCESS: return condition inserted in index.html!")
else:
    print("ERROR: Target string not found in index.html!")
