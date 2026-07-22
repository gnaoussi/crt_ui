import re

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace HTML comments <!-- ... --> inside script type="text/babel" with JSX comments {/* ... */}
def replace_html_comment(match):
    comment_text = match.group(1).strip()
    return f"{{/* {comment_text} */}}"

content = re.sub(r'<!--\s*(.*?)\s*-->', replace_html_comment, content, flags=re.DOTALL)

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'w', encoding='utf-8') as f:
    f.write(content)

print("SUCCESS: All HTML comments in index.html converted to valid Babel JSX comments!")
