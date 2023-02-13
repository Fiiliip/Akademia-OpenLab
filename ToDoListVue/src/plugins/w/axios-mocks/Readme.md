# Moxios

# Setup
1. Create `mock` folder in `public`
2. Add `import moxios from '@/plugins/w/axios-mocks'` to `main.ts`
3. Add this function `main.ts`
```
moxios.mock({})
```

4. Create mocks in `mock` folder. For eaxmple when we want to mock route `comments/project/1` we will create `comments` folder in `mock` folder, then `project` folder and then we will add `(pid).GET.json`. (Final path will be `/public/mock/comments/project/(id).GET.json`).
- NOTE: `(id)` will match any project id

5. Then we need to add this route to `main.ts` `moxios.mock({})`
```
moxios.mock({
	'GET comments/project/(pid)': true,
})
```

6. We will simulate response json in `/public/mock/comments/project/(id).GET.json`

7. We can enable/disable moxios by typing `localStorage.setItem('isMoxios', 'true')` or  `localStorage.setItem('isMoxios', 'false')`