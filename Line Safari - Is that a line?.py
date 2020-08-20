# https://www.codewars.com/kata/59c5d0b0a25c8c99ca000237

def line(grid):
    possiblePaths = []
    visited = {}
    xPos = []
    foundPaths = {}
    path = {}
    h, w = len(grid), len(grid[0])
    for x, line in enumerate(grid):
        for y, char in enumerate(line):
            if char == "X":
                xPos.append([x,y]) 
            if char in "+-|":
                visited["{},{}".format(x,y)] = False
    i = 1
    n = 0
    for startPos in xPos:
        foundPaths[i] = []
        x,y = startPos
        for u,v in (1,0),(-1,0),(0,1),(0,-1):
            nextX = x+u
            nextY = y+v
            if nextX in range(h) and nextY in range(w):
                if grid[nextX][nextY] == "X":    
                    foundPaths[i].append([])
                if (u,v) == (1,0) or (u,v) == (-1,0):
                    if grid[nextX][nextY] == "|":
                        possiblePaths.append([(nextX,nextY),(x,y),"|",n])
                        path[n] = [[nextX,nextY]]
                        n += 1
                    elif grid[nextX][nextY] == "+":
                        possiblePaths.append([(nextX,nextY),(x,y),"+",n])
                        path[n] = [[nextX,nextY]] 
                        n += 1
                if (u,v) == (0,1) or (u,v) == (0,-1):
                    if grid[nextX][nextY] == "-":
                        possiblePaths.append([(nextX,nextY),(x,y),"-",n])
                        path[n] = [[nextX,nextY]]
                        n += 1
                    elif grid[nextX][nextY] == "+":
                        possiblePaths.append([(nextX,nextY),(x,y),"+",n])
                        path[n] = [[nextX,nextY]] 
                        n += 1
        num = 0
        while True:
            try:
                pos, prePos, sign, n = possiblePaths.pop(0)
            except:
                break
            x,y = pos
            visited["{},{}".format(x,y)] = True
            x1, y1 = prePos
            if sign == "+":
                k = 0
                for nextX, nextY in (x+(y-y1),y+(x-x1)),(x-(y-y1),y-(x-x1)):
                    if 0<=nextX<=h-1 and 0<=nextY<=w-1 and [nextX,nextY] not in path[n]:
                        if grid[nextX][nextY] == "+":
                            if k > 0:
                                num += 1
                                possiblePaths.append([(nextX,nextY),(x,y),"+",num])
                                path[num] = path[n][:-1]
                                path[num].append([nextX,nextY])                               
                            else:
                                possiblePaths.append([(nextX,nextY),(x,y),"+",n])
                                path[n+k].append([nextX,nextY])   
                                k += 1
                        elif grid[nextX][nextY] == "X" and (nextX,nextY) != (startPos[0],startPos[1]):
                            foundPaths[i].append(path[n])
                            
                        elif grid[nextX][nextY] == "|":
                            if (nextX-x,nextY-y) == (1,0) or (nextX-x,nextY-y) == (-1,0):
                                if k > 0:
                                    num += 1
                                    possiblePaths.append([(nextX,nextY),(x,y),grid[nextX][nextY],num])
                                    path[num] = path[n][:-1]
                                    path[num].append([nextX,nextY])                                 
                                else:
                                    possiblePaths.append([(nextX,nextY),(x,y),grid[nextX][nextY],n])
                                    path[n+k].append([nextX,nextY])   
                                    k += 1
                        elif grid[nextX][nextY] == "-":
                            if (nextX-x,nextY-y) == (0,1) or (nextX-x,nextY-y) == (0,-1):
                                if k > 0:
                                    num += 1
                                    possiblePaths.append([(nextX,nextY),(x,y),grid[nextX][nextY],num])
                                    path[num] = path[n][:-1]
                                    path[num].append([nextX,nextY])                                
                                else:
                                    possiblePaths.append([(nextX,nextY),(x,y),grid[nextX][nextY],n])
                                    path[n+k].append([nextX,nextY])  
                                    k += 1
            else:
                nextX = x+(x-x1)
                nextY = y+(y-y1)
                if 0<=nextX<=h-1  and 0<=nextY<=w-1 and [nextX,nextY] not in path[n]:
                    if grid[nextX][nextY] == sign or grid[nextX][nextY] == "+":
                        possiblePaths.append([(nextX,nextY),(x,y),grid[nextX][nextY],n])
                        path[n].append([nextX,nextY])
                    elif grid[nextX][nextY] == "X" and (nextX,nextY) != (startPos[0],startPos[1]):
                        foundPaths[i].append(path[n])
                        
                        
        try:
            for node in visited:
                x,y = node.split(",")
                if visited[node] == False or [int(x),int(y)] not in foundPaths[i][0]:
                    return False
        except:
            return False
        i += 1
                
    return True if len(foundPaths[1]) == 1 else False        
