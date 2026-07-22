with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'r', encoding='utf-8') as f:
    content = f.read()

# Split at <script type="text/babel">
parts = content.split('<script type="text/babel">')

# Part 0 is HTML <head> and initial tags -> convert {/* ... */} back to <!-- ... -->
head_part = parts[0]
head_part = head_part.replace('{/* Google Fonts */}', '<!-- Google Fonts -->')
head_part = head_part.replace('{/* Tailwind CSS CDN */}', '<!-- Tailwind CSS CDN -->')
head_part = head_part.replace('{/* React & ReactDOM CDN */}', '<!-- React & ReactDOM CDN -->')
head_part = head_part.replace('{/* Babel CDN for JSX parsing */}', '<!-- Babel CDN for JSX parsing -->')
head_part = head_part.replace('{/* Auto-Reload / Live-Reload Script for Seamless Development */}', '<!-- Auto-Reload / Live-Reload Script for Seamless Development -->')

new_content = head_part + '<script type="text/babel">' + parts[1]

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'w', encoding='utf-8') as f:
    f.write(new_content)

print("SUCCESS: Head HTML comments restored to <!-- --> and text removed from top of page!")
