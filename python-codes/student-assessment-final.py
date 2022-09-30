#! C:/Users/WINDOWS/AppData/Local/Programs/Python/Python37/python.exe
#!/usr/bin/env python
# coding: utf-8

import pandas as pd
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score
from sklearn.feature_selection import SelectFromModel
from sklearn.tree import export_graphviz
import seaborn as sns
import numpy as np
import matplotlib.pyplot as plt
import joblib as joblib
import sys

print(sys.argv[1])