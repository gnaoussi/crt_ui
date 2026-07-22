import re

with open('/home/gervais/Development/gemini_workspace/gemini_project/crt_ui/index.html', 'r', encoding='utf-8') as f:
    lines = f.readlines()

emoji_pattern = re.compile(r'[\U00010000-\U0010ffff]|[\u2600-\u27ff]|[\u2300-\u23ff]')

matches = []
for i, line in enumerate(lines, 1):
    found = emoji_pattern.findall(line)
    if found:
        matches.append((i, line.strip(), found))

print(f"Found {len(matches)} lines with emojis/symbols:")
for line_num, line_str, chars in matches[:25]:
    print(f"L{line_num}: {chars} -> {line_str[:100]}")
